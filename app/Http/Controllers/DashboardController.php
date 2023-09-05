<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index()
    {
        $todayStudents = Student::whereDate('created_at', now()->toDateString())->count();
        $thisMonthStudents = Student::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $todayRevenue = DB::table('course_student')->whereDate('course_student.created_at', now()->toDateString())
            ->join('courses', 'course_id', 'courses.id')
            ->select('price')
            ->sum('price');

        $thisMonthRevenue = DB::table('course_student')->whereMonth('course_student.created_at', now()->month)
            ->whereYear('course_student.created_at', now()->year)
            ->join('courses', 'course_id', 'courses.id')
            ->select('price')
            ->sum('price');

        return Inertia::render('Dashboard', [
            'todayStudents' => $todayStudents,
            'thisMonthStudents' => $thisMonthStudents,
            'todayRevenue' => $todayRevenue,
            'thisMonthRevenue' => $thisMonthRevenue
        ]);
    }
}
