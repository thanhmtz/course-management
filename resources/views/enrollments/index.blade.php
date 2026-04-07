@extends('layouts.master')

@section('content')
<h3>Học viên: {{ $course->name }}</h3>

@foreach($course->students as $student)
    <p>{{ $student->name }} - {{ $student->email }}</p>
@endforeach

<p>Tổng: {{ $course->students->count() }}</p>
@endsection