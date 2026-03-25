<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1. عرض المنتجات (يفصل بين الأدمن والزبون)
 public function index()
{
    // لو الطلب جاي من مسار الأدمن، حوّله فوراً للـ Dashboard اللي فيها كل البيانات
    if (request()->is('admin*')) {
        return redirect()->route('admin.dashboard');
    }

    // لو الصفحة الرئيسية للزبون
    $products = Product::latest()->get();
    return view('shop', compact('products'));
}

    // 2. عرض صفحة "إضافة منتج جديد"
    public function create()
    {
        return view('admin.products.create');
    }

    // 3. حفظ المنتج الجديد
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'image'       => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'nullable|string',
            'colors'      => 'nullable|array',
            'sizes'       => 'nullable|array',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }

        // توليد Slug فريد
        $validated['slug'] = Str::slug($request->name) . '-' . rand(1000, 9999);
        $validated['is_ai_enabled'] = $request->has('is_ai_enabled');
        $validated['category_id'] = 1; 

        Product::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'تمت إضافة المنتج بنجاح! 🚀');
    }

    // 4. عرض صفحة التعديل
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    // 5. تحديث بيانات المنتج
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // تحديث الـ Slug لو الاسم اتغير
        if ($request->name !== $product->name) {
            $data['slug'] = Str::slug($request->name) . '-' . rand(1000, 9999);
        }

        // معالجة الصورة الجديدة وحذف القديمة
        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'تم تحديث المنتج بنجاح! ✅');
    }

    // 6. حذف المنتج
    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();
        return redirect()->route('admin.dashboard')->with('success', 'تم حذف المنتج بنجاح! 🗑️');
    }

    // 7. عرض تفاصيل المنتج للزبون
    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('product-details', compact('product'));
    }
}