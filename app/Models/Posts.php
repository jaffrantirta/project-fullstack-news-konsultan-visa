<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Posts extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    protected $fillable = [
        'title',
        'author',
        'content',
        'published_by',
        'picture'
    ];
    protected $appends = [
        'url_complete',
        'short_content',
        'picture_complete',
    ];

    /**
     * Get the trending_top that owns the Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trending_top()
    {
        return $this->belongsTo(Trending_top::class, 'id', 'post_id');
    }
    /**
     * Get the trending_bottom that owns the Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trending_bottom()
    {
        return $this->belongsTo(Trending_bottom::class, 'id', 'post_id');
    }
    /**
     * Get the hit that owns the Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hit()
    {
        return $this->belongsTo(Hit::class, 'id', 'post_id');
    }
    /**
     * Get all of the post_categories for the Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post_categories()
    {
        return $this->hasMany(Post_category::class, 'post_id', 'id');
    }
    /**
     * Get all of the count_hit for the Posts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function count_hit()
    {
        return $this->hasMany(Hit::class, 'post_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Categories::class, 'post_categories', 'post_id', 'category_id')->select('categories.id', 'category');
    }

    public function getUrlCompleteAttribute()
    {
       return URL::to('read?news='.$this->url);
    }
    public function getShortContentAttribute()
    {
        $strip_tags = strip_tags($this->content);
        return substr($strip_tags, 0, 100).'...';
    }
    public function getPictureCompleteAttribute()
    {
        return URL::to($this->picture);
    }
}
