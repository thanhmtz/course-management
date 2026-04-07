@extends('layouts.master')

@section('content')

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Danh sách khóa học</h4>
        <a href="{{ route('courses.create') }}" class="btn btn-success">+ Thêm khóa học</a>
    </div>

    {{-- FORM TÌM KIẾM + SẮP XẾP --}}
    <form method="GET" action="{{ route('courses.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input 
                type="text" 
                name="keyword" 
                class="form-control" 
                placeholder="🔍 Tìm theo tên khóa học..."
                value="{{ request('keyword') }}"
            >
        </div>

        <div class="col-md-3">
            <select name="sort" class="form-select">
                <option value="">-- Sắp xếp theo giá --</option>
                <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                    Giá tăng dần
                </option>
                <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                    Giá giảm dần
                </option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-primary w-100">Lọc</button>
        </div>

        <div class="col-md-2">
            <a href="{{ route('courses.index') }}" class="btn btn-secondary w-100">Reset</a>
        </div>
    </form>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-hover table-bordered align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th style="width: 100px;">Ảnh</th>
                    <th>Tên khóa học</th>
                    <th style="width: 120px;">Giá</th>
                    <th style="width: 130px;">Trạng thái</th>
                    <th style="width: 110px;">Số bài học</th>
                    <th style="width: 230px;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @forelse($courses as $course)
                <tr @if($course->trashed()) class="table-secondary" @endif>

                    {{-- Ảnh --}}
                    <td>
                        @if($course->image)
                            <img src="{{ asset('storage/' . $course->image) }}" 
                                 class="img-thumbnail"
                                 style="width: 80px; height: 60px; object-fit: cover;">
                        @else
                            <span class="text-muted small">Chưa có ảnh</span>
                        @endif
                    </td>

                    {{-- Tên --}}
                    <td class="text-start">{{ $course->name }}</td>

                    {{-- Giá --}}
                    <td class="fw-semibold text-success">
                    {{ number_format($course->price, 2) }}<sup> đ</sup>
                    </td>

                    {{-- Trạng thái --}}
                    <td>
                        <span class="badge bg-{{ $course->status == 'published' ? 'success' : 'secondary' }}">
                            {{ $course->status }}
                        </span>

                        @if($course->trashed())
                            <span class="badge bg-danger ms-1">Đã xóa</span>
                        @endif
                    </td>

                    {{-- Số bài --}}
                    <td>{{ $course->lessons_count ?? 0 }}</td>

                    {{-- Action --}}
                    <td>
                        @if(!$course->trashed())
                            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-warning mb-1">Edit</a>

                            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Xóa khóa học?')">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mb-1">Delete</button>
                            </form>

                            <a href="{{ route('lessons.index', $course->id) }}" class="btn btn-sm btn-info mb-1">Lessons</a>

                            <a href="{{ url('/courses/'.$course->id.'/students') }}" class="btn btn-sm btn-primary mb-1">Students</a>

                        @else
                            <form action="{{ route('courses.restore', $course->id) }}" method="POST" class="d-inline-block">
                                @csrf
                                <button class="btn btn-sm btn-success mb-1">Restore</button>
                            </form>

                            <form action="{{ route('courses.forceDelete', $course->id) }}" method="POST" class="d-inline-block"
                                  onsubmit="return confirm('Xóa vĩnh viễn?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger mb-1">Force Delete</button>
                            </form>
                        @endif
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-muted fst-italic">Không có dữ liệu</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Phân trang --}}
    <div class="d-flex justify-content-center mt-3">
        {{ $courses->links() }}
    </div>

</div>

@endsection