@extends('layouts.master')

@section('content')

<h4>Sửa khóa học</h4>

<form method="POST" action="{{ route('courses.update',$course->id) }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label>Tên</label>
        <input name="name" value="{{ $course->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Giá</label>
        <input name="price" value="{{ $course->price }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control">{{ $course->description }}</textarea>
    </div>

    <div class="mb-3">
        <label>Trạng thái</label>
        <select name="status" class="form-select">
            <option value="draft" {{ $course->status=='draft'?'selected':'' }}>Draft</option>
            <option value="published" {{ $course->status=='published'?'selected':'' }}>Published</option>
        </select>
    </div>

    <button class="btn btn-primary">Cập nhật</button>
</form>

@endsection