<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;
    public function cities()
    {
        return $this->hasMany(City::class, 'region_id');
    }

    protected $fillable = ['region_ar', 'region_en'];
    
}
