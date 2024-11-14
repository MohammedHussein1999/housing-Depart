<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Housing extends Model
{
    use HasFactory;
    protected $fillable = ['empId','empName','empNumId','region','city','collectionId','buildingId','apartmentId','roomId','status','date','type'];
}
