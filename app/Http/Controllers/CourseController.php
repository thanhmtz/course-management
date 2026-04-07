<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    // Danh sách khóa học
   public function index(Request $request)
{
    $query = Course::withCount('lessons')->withTrashed();

    // 3.1. Tìm kiếm theo tên
    if ($request->filled('keyword')) {
        $query->where('name', 'like', '%' . $request->keyword . '%');
    }

    // 3.2. Sắp xếp theo giá
    if ($request->filled('sort')) {
        if ($request->sort == 'price_asc') {
            $query->orderBy('price', 'asc'); // tăng dần
        } elseif ($request->sort == 'price_desc') {
            $query->orderBy('price', 'desc'); // giảm dần
        }
    }

    $courses = $query->paginate(2)->appends($request->all());

    return view('courses.index', compact('courses'));
}

    // Form tạo khóa học
    public function create()
    {
        return view('courses.create');
    }

    // Lưu khóa học
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image'
        ]);

        $image = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('courses', 'public');
        }

        Course::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'image' => $image,
            'status' => $request->status ?? 'draft'
        ]);

        return redirect()->route('courses.index')->with('success', 'Tạo thành công');
    }

    // Form edit
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    // Update khóa học
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric|min:1',
            'image' => 'nullable|image'
        ]);

        // Xử lý upload ảnh mới
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($course->image && Storage::disk('public')->exists($course->image)) {
                Storage::disk('public')->delete($course->image);
            }
            $course->image = $request->file('image')->store('courses', 'public');
        }

        $course->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $course->image // giữ ảnh mới hoặc cũ
        ]);

        return back()->with('success', 'Cập nhật thành công');
    }

    // Xóa khóa học (soft delete)
    public function destroy(Course $course)
    {
        $course->delete();
        return back()->with('success', 'Đã xóa');
    }

    // Khôi phục khóa học đã xóa
    public function restore($id)
    {
        $course = Course::withTrashed()->findOrFail($id);
        $course->restore();

        return back()->with('success', 'Đã khôi phục');
    }

    // Xóa vĩnh viễn (nếu muốn)
    public function forceDelete($id)
    {
        $course = Course::withTrashed()->findOrFail($id);

        // Xóa file ảnh nếu có
        if ($course->image && Storage::disk('public')->exists($course->image)) {
            Storage::disk('public')->delete($course->image);
        }

        $course->forceDelete();
        return back()->with('success', 'Đã xóa vĩnh viễn');
    }
}