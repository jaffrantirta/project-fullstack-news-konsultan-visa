<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trending_top extends Model
{
    use HasFactory;
    /**
     * Get the post associated with the Trending_top
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function post()
    {
        return $this->hasOne(Posts::class, 'id', 'post_id')->where('is_published', true);
    }
}
