<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $fillable  = [
        'date',
        'user_resume_id',
        'status_response_id',
        'post_id'
    ];

    protected $casts = [
        'date' => 'datetime',
    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user_resume()
    {
        return $this->belongsTo(User_resume::class);
    }

    public function status_response()
    {
        return $this->belongsTo(Status_response::class);
    }
}
