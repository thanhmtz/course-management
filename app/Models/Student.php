<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    // Cho phép insert dữ liệu
    protected $fillable = [
        'name',
        'email',
    ];

    // Quan hệ nhiều-nhiều với Course
    public function courses()
    {
        return $this->belongsToMany(Course::class, 'enrollments');
    }
}