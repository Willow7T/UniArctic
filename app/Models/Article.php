<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{   use HasFactory;


    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $fillable = ['title', 'intro', 'content', 'author_id']; // Example fillable attributes

    // Example relationship: an article belongs to an author
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
}
