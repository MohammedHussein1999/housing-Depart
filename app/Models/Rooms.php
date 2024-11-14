<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rooms extends Model
{
    use HasFactory;
    protected $fillable = ["unit_id", "apartment_id", "numberOfRoom", "numberPeople", "numberFloor"];
    public function unit()
    {
        return $this->belongsTo(Unit::class, "unit_id");
    }
    public function em()
    {
        return $this->hasMany(Employees::class, 'room_id');
    }
}
