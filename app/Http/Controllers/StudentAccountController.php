<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentAccountController extends Controller
{
    public function index()
    {
        return Inertia::render('Student/AccountView');
    }

    public function courses()
    {
        $student = Student::where('user_id', auth()->user()->id)->with(['course'])->first();
        return Inertia::render('Student/EnrolledCoursesView', [
            'student' => $student
        ]);
    }
}
