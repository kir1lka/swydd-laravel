<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'surname',
        'last_name',
        'city',
        'date_of_birtday',
        'phone',
        'title',
        'nationality',
        'experience',
        'education',
    ];

    protected $casts = [
        'date_of_birtday' => 'datetime',
    ];

    public function userResumes()
    {
        return $this->hasMany(User_resume::class);
    }

    public function responses()
    {
        return $this->hasManyThrough(Response::class, User_resume::class);
    }
}
