<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    /**
     * Get the place associated with the Rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }
    /**
     * Get the place_to_build associated with the Rating
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function place_to_build()
    {
        return $this->hasOne(Places_to_build::class, 'place_id', 'place_id');
    }
}
