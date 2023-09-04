<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Student;
use App\Models\User;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'objectives' => $request->objectives,
            'user_id' => auth()->user()->id
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
        $sections = Section::where('course_id', $course->id)->pluck('id');
        $time = Lesson::whereIn('section_id', $sections)->sum('seconds');

        $totalLessons = Lesson::whereIn('section_id', $sections)->count();

        return Inertia::render('Courses/GuestCourseView', [
            'course' => $course->load(['section', 'section.lesson']),
            'time' => $time,
            'totalLessons' => $totalLessons
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
        $sections = Section::where('course_id', $course->id)->pluck('id');

        $search = $request->search;
        $lessons = Lesson::latest()
            ->with('section')
            ->when($search, function ($query) use ($search) {
                $query->where('title', 'like', '%' . $search . '%');
            })
            ->whereIn('section_id', $sections)
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
        $seconds = $video_file['playtime_seconds'];

        Lesson::create([
            'title' => ucwords($request->title),
            'body' => $request->body,
            'video' => $video,
            'duration' => $duration,
            'seconds' => $seconds,
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
        $seconds = $video_file['playtime_seconds'];

        $lesson->update([
            'title' => ucwords($request->title),
            'body' => $request->body,
            'video' => $video,
            'duration' => $duration,
            'seconds' => $seconds,
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
        $student = Student::where('user_id', auth()->user()->id)->first();

        $theCourse = Course::where('id', $course->id)
            ->with('student', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->first();

        return Inertia::render('Courses/StartLessonView', [
            'lesson' => $lesson,
            'course' => $theCourse
        ]);
    }

    public function lessonsDelete(Lesson $lesson)
    {
        $lesson->delete();

        Storage::disk('public')->delete($lesson->video);

        return redirect()->back();
    }

    public function buy(Course $course)
    {
        return Inertia::render('BuyCourse/CartView', [
            'course' => $course
        ]);
    }

    public function checkout(Course $course)
    {
        $student = Student::where('user_id', auth()->user()->id)->first();
        return Inertia::render('BuyCourse/CheckoutView', [
            'course' => $course,
            'student' => $student
        ]);
    }

    public function storeCheckout(Course $course, Request $request)
    {
        $student = Student::where('user_id', auth()->user()->id)->first();
        $courseStudent = DB::table('course_student')->where('student_id', $student->id)
            ->where('course_id', $course->id)->first();

        if (!$student) {
            $request->validate([
                'fullname' => 'required',
                'region' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'order_note' => 'required',
                'payment_method' => 'required'
            ]);

            $student = Student::create([
                'full_name' => ucwords($request->fullname),
                'region' => ucwords($request->region),
                'address' => ucwords($request->address),
                'phone' => $request->phone,
                'user_id' => auth()->user()->id
            ]);

            $student->course()->attach($course->id, [
                'status' => 'Pending',
                'order_note' => ucwords($request->order_note),
                'payment_method' => $request->payment_method
            ]);
        } else if (!$courseStudent) {
            $request->validate([
                'order_note' => 'required',
                'payment_method' => 'required'
            ]);
            $student = Student::find($student->id);

            $student->course()->attach($course->id, [
                'status' => 'Pending',
                'order_note' => ucwords($request->order_note),
                'payment_method' => $request->payment_method
            ]);
        } else {
            $request->validate([
                'order_note' => 'required',
                'payment_method' => 'required'
            ]);
            return redirect()->back()->with('message', 'horey ayaad u dalbatay coursadan fadlan nagala soo xidhiidh numberka * 252633083356');
        }

        return redirect()->route('student.account');
    }
}
