<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product; // أضفنا موديل المنتجات هنا
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // عرض كل الطلبات والمنتجات في لوحة تحكم الأدمن (الموحدة)
   public function index()
{
    // 1. جلب الطلبات (لجدول الطلبات)
    $orders = Order::with('user')->latest()->get();
    
    // 2. جلب المنتجات (عشان جدول قائمة المنتجات يظهر تاني)
    $products = \App\Models\Product::latest()->get();

    // 3. الإحصائيات (عشان الكاردز اللي فوق)
    $totalRevenue = Order::sum('total_price');
    $totalProducts = \App\Models\Product::count();

    // أهم خطوة: نبعت $products و $orders مع بعض
    return view('admin.orders.index', compact('orders', 'products', 'totalRevenue', 'totalProducts'));
}

    public function store(Request $request)
    {
        try {
            // 1. التحقق من البيانات
            $validated = $request->validate([
                'city' => 'required|string',
                'street' => 'required|string',
                'details' => 'required|string',
                'total_price' => 'required|numeric',
                'items' => 'required|array',
            ]);

            // 2. حفظ الطلب
            $order = Order::create([
                'user_id' => Auth::id() ?? 1, // تأكد إن ID 1 موجود أو خليه null لو الـ database تسمح
                'city' => $request->city,
                'street' => $request->street,
                'details' => $request->details,
                'total_price' => $request->total_price,
                'items' => json_encode($request->items, JSON_UNESCAPED_UNICODE), 
                'status' => 'pending'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'تم تسجيل الطلب بنجاح'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'خطأ في السيرفر: ' . $e->getMessage()
            ], 500);
        }
    }

    // ميثود الحذف
    public function destroy(Order $order)
    {
        $order->delete();
        // بنرجع للـ dashboard الموحدة
        return redirect()->route('admin.dashboard')->with('success', 'تم حذف الطلب بنجاح');
    }

    public function updateStatus(Order $order)
    {
        // تحديث الحالة لـ shipped
        $order->update(['status' => 'shipped']);

        // إرسال الإيميل (محمي بـ try عشان لو الـ SMTP مش متظبط السيستم ميعطلش)
        try {
            if ($order->user && $order->user->email) {
                \Illuminate\Support\Facades\Mail::to($order->user->email)->send(new \App\Mail\OrderShipped($order));
            }
        } catch (\Exception $e) {
            // تجاهل خطأ الإيميل واستمر في التحديث
        }

        return back()->with('success', 'تم الشحن وتحديث الحالة بنجاح! 🚀');
    }
}