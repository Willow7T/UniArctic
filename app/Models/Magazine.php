<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magazine extends Model
{
    use HasFactory;

    protected $fillable = ['issue_name', 'year', 'month', 'published'];

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

    public function articles()
    {
        return $this->hasMany(Article::class);
    }
    use HasFactory;
}
