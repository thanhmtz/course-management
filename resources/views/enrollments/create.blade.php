@extends('layouts.master')

@section('content')

<div class="container">
    <h3 class="mb-3">Đăng ký khóa học</h3>

    {{-- Hiển thị thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Hiển thị lỗi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('enrollments.store') }}">
        @csrf

        <div class="mb-3">
            <label>Chọn khóa học</label>
            <select name="course_id" class="form-select">
                @foreach($courses as $course)
                    <option value="{{ $course->id }}"
                        {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tên</label>
            <input name="name" value="{{ old('name') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input name="email" type="email" value="{{ old('email') }}" class="form-control">
        </div>

        <button class="btn btn-primary">Đăng ký</button>
    </form>
</div>

@endsection