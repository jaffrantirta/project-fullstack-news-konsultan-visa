<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Places_to_build extends Model
{
    use HasFactory;
    /**
     * Get the user associated with the Places_to_build
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function place()
    {
        return $this->hasOne(Place::class, 'id', 'place_id');
    }
    /**
     * Get the build associated with the Places_to_build
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function build()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }
    /**
     * Get the build_ that owns the Places_to_build
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function build_()
    {
        return $this->belongsTo(Building::class, 'id', 'building_id');
    }
    /**
     * Get the rating that owns the Places_to_build
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rating()
    {
        return $this->belongsTo(Rating::class, 'place_id', 'place_id');
    }
}
