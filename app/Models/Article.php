<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'content', 'student_id']; // Example fillable attributes

    // Example relationship: an article belongs to an author
    public function author()
    {
        return $this->belongsTo(User::class, 'student_id');
    }
    use HasFactory;
}
