<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'skf_employee_id',
        'role_id',
        'department_id',
        'designation_id',
        'name',
        'email',
        'phone',
        'password',
        'image',
        'status',
        'is_management',
        'created_by',
        'created_by',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function designation()
    {
        return $this->belongsTo('App\Models\Designation');
    }

    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order','user_id');
    }
}
