<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CityRegion extends Model
{
    use HasFactory;
    protected $fillable = ["region_id", "city_id"];
}
