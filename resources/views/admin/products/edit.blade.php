@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-6 py-12 text-right" dir="rtl">
    <div class="bg-white dark:bg-gray-900 rounded-[3rem] border border-gray-100 dark:border-gray-800 p-10 shadow-2xl">
        <h2 class="text-3xl font-black text-gray-900 dark:text-white mb-8">تعديل المنتج<span class="text-indigo-600">.</span></h2>

        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">اسم المنتج</label>
                <input type="text" name="name" value="{{ $product->name }}" class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-gray-900 dark:text-white font-bold focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">السعر ($)</label>
                <input type="number" name="price" value="{{ $product->price }}" class="w-full bg-gray-50 dark:bg-gray-800 border-none rounded-2xl p-4 text-gray-900 dark:text-white font-bold focus:ring-2 focus:ring-indigo-500 transition">
            </div>

            <div>
                <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">صورة المنتج</label>
                <div class="flex items-center gap-4 mb-4">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 rounded-2xl object-cover border-2 border-indigo-500">
                    <span class="text-gray-400 text-xs font-bold italic">الصورة الحالية</span>
                </div>
                <input type="file" name="image" class="w-full text-gray-400 font-bold text-sm">
            </div>

            <div class="flex gap-4 pt-6">
                <button type="submit" class="flex-1 bg-indigo-600 text-white py-4 rounded-2xl font-black hover:bg-indigo-700 transition shadow-lg shadow-indigo-200 dark:shadow-none">
                    حفظ التعديلات ✅
                </button>
                <a href="{{ route('admin.dashboard') }}" class="px-8 py-4 bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-400 rounded-2xl font-black hover:bg-gray-200 transition">
                    إلغاء
                </a>
            </div>
        </form>
    </div>
</div>
@endsection