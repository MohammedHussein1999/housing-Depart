<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mistake extends Model
{
    use HasFactory;
    protected $fillable = ['empId','empName','empNumId','mistakeDescription','date','status','description','file'];
}
