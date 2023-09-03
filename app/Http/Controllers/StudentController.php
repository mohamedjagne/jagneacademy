<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $students = Student::latest()
            ->with('user')
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%')
                    ->orWhere('phone', 'like', '%' . $search . '%');
            })
            ->get();

        return Inertia::render('Student/ManageStudentsView', [
            'students' => $students
        ]);
    }
}
