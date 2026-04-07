<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Course CRUD
|--------------------------------------------------------------------------
*/
Route::resource('courses', CourseController::class);

// Restore (soft delete)
Route::get('courses/{id}/restore', [CourseController::class,'restore'])->name('courses.restore');


/*
|--------------------------------------------------------------------------
| Lesson
|--------------------------------------------------------------------------
*/

// danh sách theo course
Route::get('courses/{id}/lessons', [LessonController::class,'index'])->name('lessons.index');

// tạo
Route::get('courses/{id}/lessons/create', [LessonController::class,'create'])->name('lessons.create');
Route::post('lessons', [LessonController::class,'store'])->name('lessons.store');

// edit
Route::get('lessons/{lesson}/edit', [LessonController::class,'edit'])->name('lessons.edit');

// update
Route::put('lessons/{lesson}', [LessonController::class,'update'])->name('lessons.update');

// delete
Route::delete('lessons/{lesson}', [LessonController::class,'destroy'])->name('lessons.destroy');


/*
|--------------------------------------------------------------------------
| Enrollment
|--------------------------------------------------------------------------
*/

// form đăng ký
Route::get('enrollments/create', [EnrollmentController::class,'create'])->name('enrollments.create');

// lưu
Route::post('enrollments', [EnrollmentController::class,'store'])->name('enrollments.store');

// danh sách học viên theo course
Route::get('courses/{id}/students', [EnrollmentController::class,'index'])->name('enrollments.index1');

// (OPTIONAL) edit enrollment
Route::get('enrollments/{id}/edit', [EnrollmentController::class,'edit'])->name('enrollments.edit');
Route::put('enrollments/{id}', [EnrollmentController::class,'update'])->name('enrollments.update');

// (OPTIONAL) delete enrollment
Route::delete('enrollments/{id}', [EnrollmentController::class,'destroy'])->name('enrollments.destroy');
// dáh

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');