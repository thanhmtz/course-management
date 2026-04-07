<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'price',
        'description',
        'image',
        'status'
    ];

    // 1 Course -> nhiều Lesson
    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    // 1 Course -> nhiều Enrollment
    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    // Many-to-Many (Course - Student)
    public function students()
    {
        return $this->belongsToMany(Student::class, 'enrollments');
    }
}