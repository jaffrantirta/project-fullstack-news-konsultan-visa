<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post_category extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    /**
     * Get the post associated with the Post_category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->belongsTo(Posts::class, 'id', 'post_id');
    }
    /**
     * Get the category associated with the Post_category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function category()
    {
        return $this->hasOne(Categories::class, 'id', 'category_id');
    }
    /**
     * Get the post_ associated with the Post_category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post_()
    {
        return $this->hasOne(Posts::class, 'id', 'post_id')->where('is_published', true);
    }
    /**
     * Get the category_ that owns the Post_category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_()
    {
        return $this->belongsTo(Categories::class, 'category_id', 'id');
    }
}
