@extends('layouts.app')

@section('title', 'المتجر الذكي')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-right">
    <div class="flex justify-between items-end mb-16 border-b pb-8 border-gray-100 flex-row-reverse">
        <div>
            <h1 class="text-5xl font-black text-gray-900 tracking-tighter mb-2">الكتالوج.</h1>
            <p class="text-gray-400 font-medium">استعرض أحدث قطع الملابس العالمية</p>
        </div>
        <div class="bg-gray-100 px-4 py-2 rounded-2xl text-xs font-bold text-gray-500">
            عرض {{ $products->count() }} منتج
        </div>
    </div>

    @if($products->isEmpty())
        <div class="flex flex-col items-center justify-center py-32 text-center">
            <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center text-4xl mb-6 shadow-inner">📦</div>
            <h2 class="text-2xl font-bold text-gray-900 mb-2">المتجر فارغ حالياً</h2>
            <button onclick="window.location.reload()" class="mt-8 text-indigo-600 font-bold border-b-2 border-indigo-600 pb-1">تحديث الصفحة</button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
            @foreach($products as $product)
                @php $productUrl = $product->slug ? route('product.show', $product->slug) : '#'; @endphp

                <div class="group relative bg-white rounded-[3rem] p-4 shadow-sm border border-gray-50 hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                    
                    <a href="{{ $productUrl }}" class="block h-80 bg-gray-100 rounded-[2.5rem] overflow-hidden relative mb-6">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        
                        @if($product->is_ai_enabled)
                            <div class="absolute top-5 right-5 bg-white/80 backdrop-blur-md text-indigo-600 text-[10px] font-black px-4 py-2 rounded-full shadow-sm flex items-center gap-2">
                                <span class="relative flex h-2 w-2">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                                </span>
                                AI VIRTUAL TRY-ON
                            </div>
                        @endif
                    </a>

                    <div class="px-3 pb-2">
                        <div class="flex justify-between items-start mb-4 flex-row-reverse">
                            <div>
                                <a href="{{ $productUrl }}" class="hover:text-indigo-600 transition">
                                    <h3 class="font-bold text-xl text-gray-900 mb-1 leading-tight">{{ $product->name }}</h3>
                                </a>
                                
                                <div class="flex gap-2 justify-end mt-2">
                                    @foreach($product->colors ?? [] as $color)
                                        <div class="w-3 h-3 rounded-full border border-gray-100" style="background: {{ $color }}"></div>
                                    @endforeach
                                </div>
                            </div>
                            <span class="font-black text-2xl text-indigo-600 tracking-tight">${{ $product->price }}</span>
                        </div>

                        <div class="flex gap-3">
                            <a href="{{ $productUrl }}" class="w-full bg-gray-900 text-white py-4 rounded-2xl font-bold text-sm hover:bg-indigo-600 transition-colors shadow-xl flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                اختر المقاس واللون
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection