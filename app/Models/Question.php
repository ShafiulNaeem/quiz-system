<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'exam_id',
        'title',
        'ans',
        'serial',
        'marks',
        'type',
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
    public function questionBodies()
    {
        return $this->hasMany('App\Models\QuestionBody','question_id');
    }

}
