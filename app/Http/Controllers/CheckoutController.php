<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index() {
        return view('checkout');
    }

    public function placeOrder(Request $request) {
        // 1. الـ Validation
        $request->validate([
            'city' => 'required|string|max:100',
            'street' => 'required|string|max:255',
            'total_price' => 'required|numeric',
        ], [
            'city.required' => 'يرجى إدخال المدينة',
            'street.required' => 'يرجى إدخال اسم الشارع والحي',
        ]);

        // 2. حفظ الطلب في الداتابيز
        $order = Order::create([
            'user_id' => Auth::id(),
            'city' => $request->city,
            'street' => $request->street,
            'details' => $request->details,
            'total_price' => $request->total_price,
        ]);

        // هنا ممكن نربط المنتجات بجدول وسيط order_items لو حابب مستقبلاً
        
        return response()->json(['message' => 'تم استلام طلبك بنجاح يا بطل!']);
    }
}