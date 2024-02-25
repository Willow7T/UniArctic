<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = ['issue_name', 'year', 'month', 'published', 'image'];

    public function scopeGroupByMonth($query)
    {
        return $query->leftJoin('articles', 'magazines.id', '=', 'articles.magazine_id')
        ->selectRaw('month')
        ->selectRaw('COUNT(articles.id) AS article_count')
        ->groupBy('month')
        ->orderBy('month', 'ASC')
        ->pluck('article_count')
        ->values()
        ->toArray();
    }
    
    public function scopeGetYear($query, $year)
    {
        return $query->where('year', $year);
    }

    public function scopeGroupByFMonth($query, $faculty_Id)
    {
    return $query->leftJoin('articles', function($join) use ($faculty_Id) {
        $join->on('magazines.id', '=', 'articles.magazine_id')
             ->where('articles.faculty_id', '=', $faculty_Id);
    })
    ->selectRaw('month')
    ->selectRaw('COUNT(articles.id) AS article_count')
    ->groupBy('month')
    ->orderBy('month', 'ASC')
    ->pluck('article_count', 'month')
    ->values()
    ->toArray();
    }
    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    use HasFactory;
}
