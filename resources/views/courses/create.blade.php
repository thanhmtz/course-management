@extends('layouts.master')

@section('content')

<div class="container">
    <h4 class="mb-3">Thêm khóa học</h4>

    {{-- Hiển thị lỗi validate --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('courses.store') }}" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Tên</label>
            <input name="name" value="{{ old('name') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Giá</label>
            <input name="price" type="number" value="{{ old('price') }}" class="form-control">
        </div>

        <div class="mb-3">
            <label>Mô tả</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label>Trạng thái</label>
            <select name="status" class="form-select">
                <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button class="btn btn-primary">Lưu</button>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

@endsection