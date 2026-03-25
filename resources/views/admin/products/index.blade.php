@extends('layouts.app')

@section('title', 'إدارة المنتجات | ELITE')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-right">
    <div class="flex flex-col md:flex-row-reverse justify-between items-center gap-6 mb-12">
        <div>
            <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter mb-2">إدارة <span class="text-indigo-600">المنتجات.</span></h2>
            <p class="text-gray-400 font-bold italic">تحكم في مخزونك، أسعارك، وتفاصيل المنتجات</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white px-10 py-4 rounded-[2rem] font-black shadow-xl shadow-indigo-100 dark:shadow-none hover:bg-indigo-700 transition transform active:scale-95">
            + إضافة منتج جديد
        </a>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-[3rem] border border-gray-100 dark:border-gray-800 overflow-hidden shadow-sm">
        <table class="w-full text-right">
            <thead>
                <tr class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-800">
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">المنتج</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">السعر</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest">المقاسات</th>
                    <th class="px-8 py-6 text-xs font-black text-gray-400 uppercase tracking-widest text-left">إجراءات</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                @foreach($products as $product)
                <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors">
                    <td class="px-8 py-6 flex items-center gap-4 justify-start">
                        <div class="w-14 h-14 bg-gray-100 rounded-2xl overflow-hidden border border-gray-200 dark:border-gray-700">
                            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <p class="font-black text-gray-900 dark:text-white">{{ $product->name }}</p>
                            <p class="text-[10px] text-gray-400 font-bold uppercase">{{ $product->slug }}</p>
                        </div>
                    </td>
                    <td class="px-8 py-6 font-black text-indigo-600 dark:text-indigo-400">${{ number_format($product->price, 2) }}</td>
                    <td class="px-8 py-6">
                        @if($product->sizes)
                            <div class="flex gap-1 justify-start">
                                @foreach($product->sizes as $size)
                                    <span class="text-[8px] font-black bg-gray-100 dark:bg-gray-800 text-gray-500 px-2 py-1 rounded-md">{{ $size }}</span>
                                @endforeach
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex gap-4 justify-end">
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('هل أنت متأكد من الحذف؟')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600 font-black text-xs transition underline decoration-2 underline-offset-4">حذف</button>
                            </form>
                            <a href="#" class="text-indigo-500 hover:text-indigo-700 font-black text-xs transition underline decoration-2 underline-offset-4">تعديل</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection