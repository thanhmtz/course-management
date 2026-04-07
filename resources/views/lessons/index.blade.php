@extends('layouts.master')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">
    <h4>📚 Bài học: {{ $course->name }}</h4>

    <a href="{{ route('lessons.create',$course->id) }}" class="btn btn-success">
        + Thêm bài
    </a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>#</th>
            <th>Tiêu đề</th>
            <th>Video</th>
            <th>Thứ tự</th>
            <th>Hành động</th>
        </tr>
    </thead>

    <tbody>
        @forelse($lessons as $index => $lesson)
        <tr>
            <td>{{ $index + 1 }}</td>

            <td>{{ $lesson->title }}</td>

            <td>
                @if($lesson->video_url)
                    <a href="{{ $lesson->video_url }}" target="_blank" class="btn btn-sm btn-info">
                        Xem
                    </a>
                @else
                    <span class="text-muted">Không có</span>
                @endif
            </td>

            <td>{{ $lesson->order }}</td>

            <td>
                <a href="{{ route('lessons.edit',$lesson->id) }}" class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form action="{{ route('lessons.destroy',$lesson->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm"
                        onclick="return confirm('Xóa bài học?')">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center text-muted">
                Chưa có bài học nào
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<a href="/courses" class="btn btn-secondary">← Quay lại</a>

@endsection