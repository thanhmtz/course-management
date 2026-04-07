<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Course;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function index($courseId)
    {
        $course = Course::findOrFail($courseId);

        $lessons = Lesson::where('course_id', $courseId)
            ->orderBy('order')
            ->get();

        return view('lessons.index', compact('course', 'lessons'));
    }

    public function create($courseId)
    {
    // Lấy khóa học cụ thể
       $course = Course::findOrFail($courseId);

        return view('lessons.create', compact('course'));
    }

    public function store(Request $request)
    {
        Lesson::create($request->all());
        return back();
    }
    
}