<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        $orders = Order::with('user')->latest()->get();
        
        // حساب الإحصائيات
        $totalRevenue = Order::sum('total_price');
        $totalProducts = Product::count();

        // تأكد إن اسم الفيو هو اللي فيه الكود بتاعك (غالباً admin.orders.index)
        return view('admin.orders.index', compact('products', 'orders', 'totalRevenue', 'totalProducts'));
    }
}