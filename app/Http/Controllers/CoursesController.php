<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $courses = Course::latest()
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->get();

        return Inertia::render('Courses/CoursesView', [
            'courses' => $courses,
            'search' => $search
        ]);
    }

    public function storeForm()
    {
        $categories = Category::latest()->get();
        return Inertia::render('Courses/CreateCourseView', [
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'body' => 'required',
            'thumbnail' => 'required',
            'preview' => 'required',
            'category_id' => 'required',
            'objectives' => 'required'
        ]);

        $preview = $request->preview->store('preview', 'public');
        $thumbnail = $request->thumbnail->store('thumbnail', 'public');

        Course::create([
            'title' => ucwords($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'body' => $request->body,
            'thumbnail' => $thumbnail,
            'preview' => $preview,
            'category_id' => $request->category_id,
            'objectives' => $request->objectives
        ]);

        return redirect()->route('courses');
    }

    public function view(Request $request, Course $course)
    {
        return Inertia::render('Courses/ViewCourse', [
            'course' => $course
        ]);
    }

    public function guestView(Course $course)
    {
        return Inertia::render('Courses/GuestCourseView', [
            'course' => $course->load(['section', 'section.lesson'])
        ]);
    }

    public function updateForm(Course $course)
    {
        $categories = Category::latest()->get();

        return Inertia::render('Courses/UpdateCourseView', [
            'course' => $course,
            'categories' => $categories
        ]);
    }

    public function update(Course $course, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'body' => 'required',
            'thumbnail' => 'required',
            'preview' => 'required',
            'category_id' => 'required',
            'objectives' => 'required'
        ]);

        if ($request->preview == $course->preview) {
            $preview = $course->preview;
        } else {
            $preview = $request->preview->store('preview', 'public');
            Storage::disk('public')->delete($course->preview);
        }

        if ($request->thumbnail == $course->thumbnail) {
            $thumbnail = $course->thumbnail;
        } else {
            $thumbnail = $request->thumbnail->store('thumbnail', 'public');
            Storage::disk('public')->delete($course->thumbnail);
        }

        $course->update([
            'title' => ucwords($request->title),
            'description' => $request->description,
            'price' => $request->price,
            'body' => $request->body,
            'thumbnail' => $thumbnail,
            'preview' => $preview,
            'category_id' => $request->category_id,
            'objectives' => $request->objectives
        ]);

        return redirect()->route('courses');
    }

    public function delete(Course $course)
    {
        $course->delete();

        Storage::disk('public')->delete($course->thumbnail);
        Storage::disk('public')->delete($course->preview);
    }

    public function sections(Course $course, Request $request)
    {
        $search = $request->search;
        $sections = Section::where('course_id', $course->id)
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();

        return Inertia::render('Courses/CourseSectionsView', [
            'course' => $course,
            'sections' => $sections,
            'search' => $search
        ]);
    }

    public function sectionsStoreForm(Course $course)
    {
        return Inertia::render('Courses/CreateCourseSectionsView', [
            'course' => $course
        ]);
    }

    public function sectionsStore(Course $course, Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        Section::create([
            'title' => ucwords($request->title),
            'course_id' => $course->id
        ]);

        return redirect()->route('course.sections', $course->id);
    }

    public function sectionsDelete(Section $section)
    {
        $section->delete();

        return redirect()->back();
    }

    public function sectionsUpdateForm(Course $course, Section $section)
    {
        return Inertia::render('Courses/UpdateCourseSectionsView', [
            'course' => $course,
            'section' => $section
        ]);
    }

    public function sectionsUpdate(Course $course, Section $section, Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $section->update([
            'title' => ucwords($request->title)
        ]);

        return redirect()->route('course.sections', $course->id);
    }

    public function lessons(Course $course, Request $request)
    {
        $search = $request->search;
        $lessons = Lesson::latest()
            ->with('section')
            ->get();

        return Inertia::render('Courses/CourseLessonsView', [
            'course' => $course,
            'lessons' => $lessons,
            'search' => $search
        ]);
    }

    public function lessonsStoreForm(Course $course)
    {
        $sections = Section::all();

        return Inertia::render('Courses/CreateCourseLessonsView', [
            'course' => $course,
            'sections' => $sections
        ]);
    }

    public function lessonsStore(Course $course, Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'video' => 'required',
            'section_id' => 'required'
        ]);

        $video = $request->video->store('videos', 'public');

        $getID3 = new getID3;

        $video_file = $getID3->analyze('storage/' . $video);

        $duration = $video_file['playtime_string'];

        Lesson::create([
            'title' => ucwords($request->title),
            'body' => $request->body,
            'video' => $video,
            'duration' => $duration,
            'section_id' => $request->section_id
        ]);

        return redirect()->route('course.lessons', $course->id);
    }

    public function lessonsUpdateForm(Course $course, Lesson $lesson)
    {
        $sections = Section::all();

        return Inertia::render('Courses/UpdateCourseLessonsView', [
            'course' => $course,
            'sections' => $sections,
            'lesson' => $lesson
        ]);
    }

    public function lessonsUpdate(Course $course, Request $request, Lesson $lesson)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'video' => 'required',
            'section_id' => 'required'
        ]);

        if ($request->video == $lesson->video) {
            $video = $lesson->video;
        } else {
            $video = $request->video->store('videos', 'public');
            Storage::disk('public')->delete($lesson->video);
        }

        $getID3 = new getID3;

        $video_file = $getID3->analyze('storage/' . $video);

        $duration = $video_file['playtime_string'];

        $lesson->update([
            'title' => ucwords($request->title),
            'body' => $request->body,
            'video' => $video,
            'duration' => $duration,
            'section_id' => $request->section_id
        ]);

        return redirect()->route('course.lessons', $course->id);
    }

    public function viewLesson(Course $course, Lesson $lesson)
    {
        return Inertia::render('Courses/ViewCourseLesson', [
            'lesson' => $lesson
        ]);
    }

    public function startLesson(Course $course, Lesson $lesson)
    {
        return Inertia::render('Courses/StartLessonView', [
            'lesson' => $lesson,
            'course' => $course->load(['section', 'section.lesson'])
        ]);
    }
}
