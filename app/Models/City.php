<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function regions()
    {
        return $this->belongsTo(Region::class, "region_id");
    }
    protected $fillable = ['city_ar', 'city_en'];
    public function coms()
    {
        return $this->hasMany(Compon::class, 'city_id');
    }
}
