<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
protected $fillable = ['name','slug'];

    // علاقة القسم بالمنتجات (عشان لو احتجتها بعدين)
    public function products()
    {
        return $this->hasMany(Product::class);
    }}
