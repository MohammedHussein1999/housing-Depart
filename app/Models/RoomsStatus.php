<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomsStatus extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'status', 'active', "apartment_id	"];
    public function apartmentNew()
    {
        return $this->belongsTo(apartmentNew::class, "apartmentNew_id");
    }
}
