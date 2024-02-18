<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{   use HasFactory;



    protected $fillable = ['title', 'intro', 'image', 'content', 'selected', 'published', 'anonymous', 'author_id','faculty_id', 'magazine_id']; // Example fillable attributes

    // Example relationship: an article belongs to an author
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    public function comments()
    {
    return $this->hasMany(Comment::class);
    }
    public function magazine()
    {
        return $this->belongsTo(Magazine::class, 'magazine_id');
    }
    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_id');
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    
}
