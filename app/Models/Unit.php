<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'units';
    protected $fillable = ["numberOfFloors", "typeHousing", "nameUnit", "compon_id"];

    public function compon()
    {
        return $this->belongsTo(Compon::class, "compon_id");
    }

    public function rooms()
    {
        return $this->hasMany(Rooms::class, "unit_id");
    }
}
