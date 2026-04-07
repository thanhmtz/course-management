@extends('layouts.master')

@section('content')
<h3>Sửa bài học</h3>

<form method="POST" action="{{ route('lessons.update', $lesson->id) }}">
    @csrf
    @method('PUT')

    <label>Tiêu đề</label><br>
    <input name="title" value="{{ $lesson->title }}"><br>

    <label>Nội dung</label><br>
    <textarea name="content">{{ $lesson->content }}</textarea><br>

    <label>Video URL</label><br>
    <input name="video_url" value="{{ $lesson->video_url }}"><br>

    <label>Thứ tự</label><br>
    <input name="order" type="number" value="{{ $lesson->order }}"><br>

    <br>
    <button>Cập nhật</button>
</form>
@endsection