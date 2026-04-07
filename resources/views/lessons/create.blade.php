@extends('layouts.master')

@section('content')

<h4>Thêm bài học cho khóa: {{ $course->name }}</h4>

<form method="POST" action="{{ route('lessons.store') }}">
    @csrf

    <!-- Khóa học ẩn -->
    <input type="hidden" name="course_id" value="{{ $course->id }}">

    <div class="mb-3">
        <label>Tên bài học</label>
        <input name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Nội dung</label>
        <textarea name="content" class="form-control"></textarea>
    </div>

    <div class="mb-3">
        <label>Video URL</label>
        <input name="video_url" class="form-control">
    </div>

    <div class="mb-3">
        <label>Thứ tự</label>
        <input type="number" name="order" class="form-control" value="0">
    </div>

    <button class="btn btn-success">Lưu bài học</button>
</form>

@endsection