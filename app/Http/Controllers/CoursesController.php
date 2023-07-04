<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index(){
        return Inertia::render('Courses/CoursesView');
    }

    public function storeForm(){
        return Inertia::render('Courses/CreateCourseView');
    }

    public function store(Request $request){
        dd($request->body);
    }
}
