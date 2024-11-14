<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;



    protected $fillable = ['city', 'region', 'name', 'location', 'count', 'file', 'active', 'attach'];
}
