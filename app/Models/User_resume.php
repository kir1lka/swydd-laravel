<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_resume extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'resume_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Resume::class);
    }
    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
