<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Section;
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
            'course' => $course
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

    public function sections(Course $course)
    {
        $sections = Section::where('course_id', $course->id)
            ->latest()->get();

        return Inertia::render('Courses/CourseSectionsView', [
            'course' => $course,
            'sections' => $sections
        ]);
    }
}
