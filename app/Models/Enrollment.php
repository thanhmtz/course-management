<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enrollment extends Model
{
    protected $fillable = [
        'course_id',
        'student_id'
    ];

    // thuộc Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // thuộc Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}