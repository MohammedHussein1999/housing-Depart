<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{

    use HasFactory;
    protected $table = 'employees';

    protected $fillable = ['room_id', 'date', 'numberOr', 'name', 'gender', 'job', 'idNumber', 'region', 'lection'];
    public function room()
    {
        return $this->belongsTo(Rooms::class, 'room_id');
    }
}
