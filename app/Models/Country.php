<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'note'
    ];
    public function positions()
    {
        return $this->belongsToMany(Position::class, CountryPosition::class);
    }
    public function services()
    {
        return $this->belongsToMany(Service::class, CountryService::class);
    }
}
