<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionBody extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'exam_id',
        'question_id',
        'level',
        'input_type',
        'input_name',
        'input_id',
        'placeholder',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function createdByName()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }

    public function exam()
    {
        return $this->belongsTo('App\Models\Exam');
    }

    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }
}
