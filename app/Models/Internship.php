<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Internship extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'company',
        'supervisor',
        'start_date',
        'end_date',
        'status',
        'score',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
