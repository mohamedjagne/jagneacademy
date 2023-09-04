<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
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

    public function startCourse(Course $course)
    {
        $sections = Section::where('course_id', $course->id)->pluck('id');
        $time = Lesson::whereIn('section_id', $sections)->sum('seconds');

        $totalLessons = Lesson::whereIn('section_id', $sections)->count();

        return Inertia::render('Student/StartCourseView', [
            'course' => $course->load(['section', 'section.lesson']),
            'time' => $time,
            'totalLessons' => $totalLessons
        ]);
    }
}
