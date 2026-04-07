<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;

class EnrollmentController extends Controller
{
    /**
     * Hiển thị danh sách học viên của một khóa học
     */
    public function index($courseId)
    {
        // Lấy khóa học cùng với học viên
        $course = Course::with('students')->findOrFail($courseId);

        // Lấy danh sách học viên
        $students = $course->students;

        // Truyền cả course và students sang view
        return view('enrollments.index1', compact('course', 'students'));
    }

    /**
     * Form đăng ký học viên vào khóa học
     */
    public function create()
    {
        // Lấy tất cả khóa học để hiển thị dropdown
        $courses = Course::all();

        // Truyền biến $courses sang view
        return view('enrollments.create', compact('courses'));
    }

    /**
     * Lưu đăng ký học viên
     */
    public function store(Request $request)
    {
        // Validate dữ liệu nhập
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'name'      => 'required|string|max:255',
            'email'     => 'required|email|max:255',
        ]);

        // Tạo hoặc lấy học viên theo email
        $student = Student::firstOrCreate(
            ['email' => $request->email],
            ['name' => $request->name]
        );

        // Lấy khóa học
        $course = Course::findOrFail($request->course_id);

        // Gán học viên vào khóa học (không bị trùng)
        $course->students()->syncWithoutDetaching([$student->id]);

        // Chuyển về lại form với thông báo thành công
        return back()->with('success', 'Đăng ký thành công');
    }
}