@extends('layouts.master')

@section('content')

<h3>Dashboard</h3>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng số khóa học</h5>
                <p class="card-text fs-3">{{ $totalCourses }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-success mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng số học viên</h5>
                <p class="card-text fs-3">{{ $totalStudents }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-warning mb-3">
            <div class="card-body">
                <h5 class="card-title">Tổng doanh thu</h5>
                <p class="card-text fs-3">${{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card text-white bg-danger mb-3">
            <div class="card-body">
                <h5 class="card-title">Khóa học nhiều học viên nhất</h5>
                <p class="card-text">
                    {{ $mostEnrolledCourse ? $mostEnrolledCourse->name . ' (' . $mostEnrolledCourse->students_count . ')' : 'Chưa có dữ liệu' }}
                </p>
            </div>
        </div>
    </div>
</div>

<h4>5 khóa học mới nhất</h4>
<table class="table table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Tên khóa học</th>
            <th>Giá</th>
            <th>Trạng thái</th>
            <th>Ngày tạo</th>
        </tr>
    </thead>
    <tbody>
        @forelse($latestCourses as $course)
            <tr>
                <td>{{ $course->name }}</td>
                <td>{{ number_format($course->price, 2) }}<sup> đ</sup></td>
                <td>{{ $course->status }}</td>
                <td>{{ $course->created_at->format('d-m-Y') }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">Chưa có dữ liệu</td>
            </tr>
        @endforelse
    </tbody>
</table>

@endsection