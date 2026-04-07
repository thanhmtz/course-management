@extends('layouts.master')

@section('content')

<div class="container">
    <h3 class="mb-3">Học viên của khóa: {{ $course->name }}</h3>

    <a href="{{ route('courses.index') }}" class="btn btn-secondary mb-3">← Quay lại</a>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Tên</th>
                <th>Email</th>
            </tr>
        </thead>

        <tbody>
            @forelse($students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->email }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">Chưa có học viên</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection