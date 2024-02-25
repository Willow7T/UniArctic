<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $fillable = ['name','image'];

    public function users()
    {
        return $this->hasMany(User::class, 'faculty_id');
    }
    public function articles()
    {
        return $this->hasMany(Article::class, 'faculty_id');
    }
}
