<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // <--- 1. Import hay
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory; // <--- 2. Use hay jowwa el Class

    protected $fillable = ['name', 'description', 'price', 'stock', 'is_active'];
}