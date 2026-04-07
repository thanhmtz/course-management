<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Tổng số khóa học
        $totalCourses = Course::count();

        // Tổng số học viên
        $totalStudents = Student::count();

        // Tổng doanh thu (tính các khóa published, không phân biệt chữ hoa chữ thường)
        $totalRevenue = Course::whereRaw("LOWER(status) = 'published'")
            ->sum('price');

        // Khóa học nhiều học viên nhất
        $mostEnrolledCourse = Course::withCount('students')
            ->orderByDesc('students_count')
            ->first();

        // 5 khóa học mới nhất
        $latestCourses = Course::orderByDesc('created_at')->take(5)->get();

        return view('dashboard.index', compact(
            'totalCourses',
            'totalStudents',
            'totalRevenue',
            'mostEnrolledCourse',
            'latestCourses'
        ));
    }
}