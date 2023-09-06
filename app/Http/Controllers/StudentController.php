<?php

namespace App\Http\Controllers;

use App\Models\Course;
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

    public function view(Student $student)
    {
        $theStudent = $student->load('course');

        return Inertia::render('Student/ViewStudentCourses', [
            'student' => $theStudent
        ]);
    }

    public function studentCourseUpdateForm(Student $student, Course $course)
    {
        $theCourse = Course::where('id', $course->id)
            ->with('student', function ($query) use ($student) {
                $query->where('student_id', $student->id);
            })
            ->first();

        return Inertia::render('Student/UpdateStudentCourseView', [
            'course' => $theCourse
        ]);
    }

    public function studentCourseUpdate(Student $student, Course $course, Request $request)
    {
        $student->course()->updateExistingPivot($course->id, ['status' => $request->status]);
        return redirect()->route('student.view', $student->id);
    }
}
