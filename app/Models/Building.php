<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'adrress',
        'phone',
        'description',
    ];
    /**
     * Get the place_to_build that owns the Building
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place_to_build(): BelongsTo
    {
        return $this->belongsTo(Places_to_build::class, 'id', 'building_id');
    }
    /**
     * Get all of the place_to_build_ for the Building
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function place_to_build_()
    {
        return $this->hasMany(Places_to_build::class, 'id', 'building_id');
    }
    /**
     * Get the user_point that owns the Building
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user_point()
    {
        return $this->belongsTo(User_point::class, 'id', 'building_id');
    }
}
