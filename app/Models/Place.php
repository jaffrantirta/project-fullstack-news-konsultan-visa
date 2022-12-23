<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    /**
     * Get the user that owns the Place
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place_to_build()
    {
        return $this->belongsTo(Places_to_build::class, 'id', 'place_id');
    }
    /**
     * Get the rating that owns the Place
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rating()
    {
        return $this->belongsTo(Rating::class, 'id', 'place_id');
    }
}
