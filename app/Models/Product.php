<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'colors' => 'array',
        'sizes' => 'array',
        'is_ai_enabled' => 'boolean',
    ];

    protected $fillable = [
        'category_id', 
        'name', 
        'slug', 
        'description', 
        'price', 
        'image', 
        'is_ai_enabled', 
        'colors', 
        'sizes'
    ];
}