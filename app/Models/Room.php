<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = ['collectionId','buildingId','apartmentNum','roomNum','floorNum','count','file','active','attach','other'];
}
