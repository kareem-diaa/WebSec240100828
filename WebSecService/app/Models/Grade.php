<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $table = 'grades';

    protected $fillable = [
        'student_name',
        'course_code',
        'course_title',
        'credit_hours',
        'grade',
        'term',
    ];

    // ── Helper: convert letter grade → grade points ──────────────────────
    public static function gradePoints(): array
    {
        return [
            'A'  => 4.0, 'A-' => 3.7,
            'B+' => 3.3, 'B'  => 3.0, 'B-' => 2.7,
            'C+' => 2.3, 'C'  => 2.0, 'C-' => 1.7,
            'D+' => 1.3, 'D'  => 1.0,
            'F'  => 0.0,
        ];
    }

    // ── Helper: get points for this record's grade ────────────────────────
    public function getPoints(): float
    {
        return self::gradePoints()[$this->grade] ?? 0.0;
    }
}