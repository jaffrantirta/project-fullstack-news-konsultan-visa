<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    use \Staudenmeir\EloquentEagerLimit\HasEagerLimit;
    /**
     * Get the post_category that owns the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post_category()
    {   
        return $this->belongsTo(Post_category::class, 'id', 'category_id');
    }
    /**
     * Get all of the post_category for the Categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post_category_()
    {
        return $this->hasMany(Post_category::class, 'category_id', 'id')->latest();
    }
    protected $fillable = [
        'category'
    ];
}
