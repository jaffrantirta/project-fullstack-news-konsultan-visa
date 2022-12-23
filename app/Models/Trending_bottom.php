<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Trending_bottom extends Model
{
    use HasFactory;

    protected $appends = [
        'url_complete',
        'short_content',
        'picture_complete',
    ];
    /**
     * Get the post associated with the Trending_top
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Posts::class, 'id', 'post_id')->where('is_published', true);
    }
    /**
     * The category that belong to the Trending_bottom
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'post_categories', 'post_id', 'category_id')->select('categories.id', 'categories.category');
    }

    public function getUrlCompleteAttribute()
    {
       return URL::to('read?news='.$this->url);
    }
    public function getShortContentAttribute()
    {
        return substr($this->content, 0, 100).'...';
    }
    public function getPictureCompleteAttribute()
    {
        return URL::to($this->picture);
    }
}
