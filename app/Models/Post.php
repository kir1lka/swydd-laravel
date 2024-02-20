<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillabel = [
        'title_job',
        'price',
        'experience',
        'city',
        'logo',
        'name_company',
        'description',
        'phone',
        'phone_name',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
