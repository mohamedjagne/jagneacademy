<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $todayStudents = Student::whereDate('created_at', now()->toDateString())->count();
        $thisMonthStudents = Student::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $todayRevenue = DB::table('course_student')->whereDate('course_student.updated_at', now()->toDateString())
            ->join('courses', 'course_id', 'courses.id')
            ->select('price', 'status')
            ->where('status', 'Active')
            ->sum('price');

        $thisMonthRevenue = DB::table('course_student')->whereMonth('course_student.updated_at', now()->month)
            ->whereYear('course_student.updated_at', now()->year)
            ->join('courses', 'course_id', 'courses.id')
            ->select('price', 'status')
            ->where('status', 'Active')
            ->sum('price');

        $from = $request->date[0] ?? now()->today();
        $to = $request->date[1] ?? now()->today()->addDay(7);

        $period = CarbonPeriod::create($from, $to);

        // Iterate over the period
        foreach ($period as $date) {
            $dates[] = $date->format('Y-m-d');
        }

        foreach ($dates as $date) {
            $studentCount = Student::whereDate('created_at', $date)->count();
            $newStudents[] = $studentCount;
        }

        return Inertia::render('Dashboard', [
            'todayStudents' => $todayStudents,
            'thisMonthStudents' => $thisMonthStudents,
            'todayRevenue' => $todayRevenue,
            'thisMonthRevenue' => $thisMonthRevenue,
            'dates' => $dates,
            'from' => $from,
            'to' => $to,
            'type' => $request->type,
            'newStudents' => $newStudents
        ]);
    }
}
