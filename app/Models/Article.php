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
    public function views()
    {
        return $this->hasMany(ArticleView::class);
    }
    public static function getArticlesWAuthen($userId, $published)
    {
    $articles = self::where('author_id', $userId)
        ->where('published', $published)
        ->get();

    $count = self::where('author_id', $userId)
        ->where('published', $published)
        ->count();

    return ['articles' => $articles, 'count' => $count];
    }
    public static function getArticlesWMag($magazineID, $published)
    {
    $articles = self::where('magazine_id', $magazineID)
        ->where('published', $published)
        ->get();

    $count = self::where('magazine_id', $magazineID)
        ->where('published', $published)
        ->count();

    return ['articles' => $articles, 'count' => $count];
    }
    public static function getArticlesWFacu($facultyID, $published)
    {
    $articles = self::where('faculty_id', $facultyID)
        ->where('published', $published)
        ->get();

    $count = self::where('faculty_id', $facultyID)
        ->where('published', $published)
        ->count();

    return ['articles' => $articles, 'count' => $count];
    }
    
    
}
