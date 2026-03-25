<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'city', 'street', 'details', 'total_price', 'items', 'status'
    ];

    // ✅ ضِف هذه العلاقة فوراً
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    // اختياري: لو حابب الـ items تتعامل كـ array تلقائياً
    protected $casts = [
        'items' => 'array',
    ];
}