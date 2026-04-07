@extends('layouts.master')

@section('content')
<h3>Sửa đăng ký</h3>

<form method="POST" action="{{ route('enrollments.update', $enrollment->id) }}">
    @csrf
    @method('PUT')

    <label>Khóa học</label><br>
    <select name="course_id">
        @foreach($courses as $course)
            <option value="{{ $course->id }}"
                {{ $enrollment->course_id == $course->id ? 'selected' : '' }}>
                {{ $course->name }}
            </option>
        @endforeach
    </select><br>

    <label>Học viên</label><br>
    <select name="student_id">
        @foreach($students as $student)
            <option value="{{ $student->id }}"
                {{ $enrollment->student_id == $student->id ? 'selected' : '' }}>
                {{ $student->name }}
            </option>
        @endforeach
    </select><br>

    <br>
    <button>Cập nhật</button>
</form>
@endsection