<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'subject_id',
        'exam_id',
        'question_text',
        'difficulty_level',
        'attachment_url',
    ];
}
