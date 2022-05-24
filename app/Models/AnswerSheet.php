<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnswerSheet extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_id',
        'question_id',
        'question_body_id',
        'participation_number',
        'ans',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
    public function questionBody()
    {
        return $this->belongsTo('App\Models\QuestionBody');
    }
}
