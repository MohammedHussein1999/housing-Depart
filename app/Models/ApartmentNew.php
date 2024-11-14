<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApartmentNew extends Model
{
    use HasFactory;
    protected $fillable = ["unit_id", "numberOfApartment", "numberOfFloor", "numberWC", "electricityMeter", "accountNumber"];


}
