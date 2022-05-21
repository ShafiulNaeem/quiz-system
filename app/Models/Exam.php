<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'exam_time',
        'time_specification',
        'status',
        'created_by',
        'created_at',
        'updated_at',
    ];

    public function createdByName()
    {
        return $this->belongsTo('App\Models\User','created_by');
    }
}
