<?php

namespace App\Models;

use App\Models\City;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compon extends Model
{
    use HasFactory;
    public function city()
    {
        return $this->belongsTo(City::class, "city_id");
    }
    protected $fillable = ["excel_file", "nameRegion", "nameCity", "nameComplex", "city_id"];

    public function units()
    {
        return $this->hasMany(Unit::class, "compon_id");
    }
}
