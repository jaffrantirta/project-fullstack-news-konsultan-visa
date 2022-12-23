<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hit extends Model
{
    use HasFactory;
    /**
     * Get the post associated with the Hit
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Posts::class, 'id', 'post_id')->where('is_published', true);
    }
    /**
     * Get the count_post that owns the Hit
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function count_post()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
