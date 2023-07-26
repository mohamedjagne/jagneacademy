<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        $courses = Course::latest()->get();

        return Inertia::render('HomeView', [
            'categories' => $categories,
            'courses' => $courses
        ]);
    }
}
