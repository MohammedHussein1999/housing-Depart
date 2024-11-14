<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;
    protected $fillable = ['collectionId','buildingId','floorNum','apartmentNum','bathroomCount','electricity','accountNum','file','active','attach','other'];
}
