<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class SalesController extends Controller
{
    public function transactions(Request $request)
    {
        $search = $request->search;

        $transactions = DB::table('course_student')
            ->join('students', 'student_id', 'students.id')
            ->join('courses', 'course_id', 'courses.id')
            ->select('full_name', 'phone', 'title', 'price', 'course_student.created_at', 'status')
            ->where('status', 'Active')
            ->when($search, function ($query) use ($search) {
                $query->where('full_name', 'like', '%' . $search . '%');
            })
            ->latest()
            ->get();
        return Inertia::render('Sales/TransactionsView', [
            'transactions' => $transactions,
            'search' => $search
        ]);
    }

    public function courses()
    {
        $courses = Course::with('student')
            ->withCount('student')
            ->get();

        return Inertia::render('Sales/CoursesSalesView', [
            'courses' => $courses
        ]);
    }
}
