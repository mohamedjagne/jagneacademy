<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::latest()->get();
        return Inertia::render('Courses/CoursesView', [
            'courses' => $courses
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
}
