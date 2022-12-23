<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_point extends Model
{
    use HasFactory;
    /**
     * Get the building associated with the User_point
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function building()
    {
        return $this->hasOne(Building::class, 'id', 'building_id');
    }
}
