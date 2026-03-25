@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div id="product-root" class="max-w-7xl mx-auto px-6 py-16 text-right" 
      x-data="{ 
        selectedSize: '{{ $product->sizes[0] ?? 'M' }}', 
        selectedColor: '{{ $product->colors[0] ?? 'Default' }}',
        showSizeGuide: false,
        quantity: 1,
        showAIModal: false,
        isProcessing: false,
        generatedTryOnImage: null 
      }">
    
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
        <div class="aspect-square bg-white dark:bg-gray-900 rounded-[3rem] overflow-hidden shadow-2xl border border-gray-50 dark:border-gray-800 group relative">
            <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
            @if($product->is_ai_enabled)
                <div class="absolute top-8 right-8 bg-white/90 dark:bg-gray-800/90 backdrop-blur px-4 py-2 rounded-2xl font-black text-indigo-600 dark:text-indigo-400 text-[10px] tracking-widest shadow-sm border border-indigo-50 dark:border-indigo-900/30">
                    AI READY ✨
                </div>
            @endif
        </div>

        <div class="flex flex-col">
            <h1 class="text-5xl font-black text-gray-900 dark:text-white mb-4 tracking-tighter">{{ $product->name }}</h1>
            <span class="text-3xl font-black text-indigo-600 dark:text-indigo-400 mb-8">${{ $product->price }}</span>
            <p class="text-gray-500 dark:text-gray-400 text-lg mb-12 border-r-4 border-indigo-50 dark:border-indigo-900/30 pr-8 leading-relaxed">{{ $product->description }}</p>

            <div class="mb-10">
                <span class="text-xs font-black uppercase text-gray-400 tracking-widest block mb-4">اختر اللون</span>
                <div class="flex flex-wrap gap-4">
                    @foreach($product->colors ?? [] as $color)
                        <button @click="selectedColor = '{{ $color }}'"
                            :class="selectedColor === '{{ $color }}' ? 'ring-4 ring-indigo-500 ring-offset-4 scale-110' : 'opacity-60'"
                            class="w-10 h-10 rounded-full transition-all duration-300 shadow-sm border border-gray-200"
                            style="background: {{ $color }}"></button>
                    @endforeach
                </div>
            </div>

            <div class="mb-10">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-xs font-black uppercase text-gray-400 tracking-widest">اختر المقاس</span>
                    <button @click="showSizeGuide = true" class="text-[10px] font-bold text-indigo-600 underline underline-offset-4">دليل المقاسات</button>
                </div>
                <div class="flex flex-wrap gap-4">
                    @foreach($product->sizes ?? [] as $size)
                        <button @click="selectedSize = '{{ $size }}'" 
                            :class="selectedSize === '{{ $size }}' ? 'bg-indigo-600 text-white shadow-xl scale-110' : 'bg-white dark:bg-gray-800 text-gray-900 dark:text-white border border-gray-100 dark:border-gray-700'"
                            class="w-14 h-14 rounded-2xl font-black transition-all duration-300">{{ $size }}</button>
                    @endforeach
                </div>
            </div>

            <div class="flex flex-col gap-4">
                <button onclick='addToCart(@json($product))' class="w-full bg-gray-900 dark:bg-indigo-600 text-white py-6 rounded-[2.2rem] font-black text-lg hover:bg-indigo-700 transition shadow-2xl active:scale-95">أضف إلى حقيبة التسوق</button>
                
                @if($product->is_ai_enabled)
                    <button @click="showAIModal = true" 
                            class="w-full bg-gradient-to-r from-indigo-500 to-purple-600 text-white py-6 rounded-[2.2rem] font-black text-sm shadow-xl hover:scale-[1.02] transition-all flex items-center justify-center gap-3 relative overflow-hidden">
                        <span class="animate-pulse">✨</span> 
                        تجربة القياس الافتراضي (AI Try-On)
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div x-show="showAIModal" x-cloak class="fixed inset-0 z-[250] flex items-center justify-center p-4 bg-gray-900/80 backdrop-blur-md">
        <div @click.away="if(!isProcessing) showAIModal = false" class="bg-white dark:bg-gray-900 w-full max-w-2xl rounded-[3rem] overflow-hidden shadow-2xl border border-white/10 relative text-right flex transition-all">
            <button @click="showAIModal = false; generatedTryOnImage = null" x-show="!isProcessing" class="absolute top-6 left-6 p-2 bg-gray-100 dark:bg-gray-800 rounded-full text-gray-400 hover:text-red-500 z-10 transition">✕</button>
            <div class="bg-indigo-50 dark:bg-gray-800/50 p-8 flex flex-col items-center justify-center border-l border-gray-100 dark:border-gray-800 w-2/5">
                <div class="w-40 h-52 bg-white dark:bg-gray-800 rounded-3xl shadow-lg overflow-hidden border-4 border-white dark:border-gray-700">
                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover">
                </div>
                <h4 class="mt-6 font-black text-indigo-600 dark:text-indigo-400 text-sm tracking-tighter">{{ $product->name }}</h4>
            </div>
            <div class="p-10 flex flex-col justify-center flex-1 min-h-[450px]">
                <template x-if="!isProcessing && !generatedTryOnImage">
                    <div class="text-center">
                        <h3 class="text-2xl font-black dark:text-white mb-2 leading-tight">جاهز للتجربة؟ 🧥</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8 font-bold">ارفع صورة واضحة لنفسك ليقوم الـ AI بتركيب القطعة عليك بدقة.</p>
                        <label class="w-full flex flex-col items-center justify-center gap-3 p-8 border-2 border-dashed border-indigo-200 dark:border-indigo-800 rounded-3xl cursor-pointer hover:bg-indigo-50 dark:hover:bg-indigo-900/10 transition shadow-inner">
                            <span class="text-3xl">📸</span>
                            <span class="text-xs font-black text-indigo-600">ارفع صورة من جهازك</span>
                            <input type="file" class="hidden" onchange="runAI(this)">
                        </label>
                    </div>
                </template>
                <template x-if="isProcessing">
                    <div class="flex flex-col items-center justify-center py-10">
                        <div class="relative w-20 h-20 mb-6">
                            <div class="absolute inset-0 border-4 border-indigo-100 dark:border-indigo-900 rounded-full"></div>
                            <div class="absolute inset-0 border-4 border-indigo-600 rounded-full border-t-transparent animate-spin"></div>
                        </div>
                        <h3 class="text-lg font-black dark:text-white mb-2">محرك ELITE AI يعمل..</h3>
                        <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center">جاري دمج الأبعاد وتوليد الإطلالة</p>
                    </div>
                </template>
                <template x-if="generatedTryOnImage && !isProcessing">
                    <div class="text-center animate-fade-in flex flex-col flex-1">
                        <div class="w-full aspect-[3/4] max-w-[280px] mx-auto bg-gray-100 dark:bg-gray-800 rounded-3xl mb-6 overflow-hidden border-4 border-green-500/20 shadow-2xl relative">
                            <img :src="generatedTryOnImage" class="w-full h-full object-cover">
                            <div class="absolute bottom-4 right-4 bg-green-500 text-white text-[10px] px-3 py-1.5 rounded-full font-black shadow-lg">طقم مثالي! ✅</div>
                        </div>
                        <div class="flex gap-3 justify-center">
                            <button @click="generatedTryOnImage = null" class="w-2/5 py-4 bg-gray-100 dark:bg-gray-800 rounded-2xl font-bold text-xs dark:text-white">إعادة</button>
                            <button @click="showAIModal = false; addToCart(@json($product))" class="w-3/5 py-4 bg-indigo-600 text-white rounded-2xl font-black text-xs shadow-lg">أضف للسلة</button>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <div x-show="showSizeGuide" 
         x-cloak 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         class="fixed inset-0 z-[300] flex items-center justify-center bg-gray-900/80 backdrop-blur-md p-4 text-right">
        
        <div @click.away="showSizeGuide = false" 
             class="bg-white dark:bg-gray-900 w-full max-w-md rounded-[3rem] p-10 shadow-2xl relative border border-white/10">
            <button @click="showSizeGuide = false" class="absolute top-8 left-8 p-2 bg-gray-100 dark:bg-gray-800 rounded-full text-gray-400 hover:text-red-500 transition">✕</button>
            <h3 class="text-3xl font-black mb-1 dark:text-white tracking-tighter">دليل المقاسات 📏</h3>
            <p class="text-[10px] text-indigo-500 font-black uppercase tracking-widest mb-8">اضغط على المقاس لاختياره مباشرة</p>

            <div class="flex flex-col gap-3">
                <div class="grid grid-cols-3 gap-4 px-6 text-[10px] font-black text-gray-400 uppercase">
                    <div>المقاس</div><div>العرض</div><div>الطول</div>
                </div>
                @php 
                    $guide = ['M' => ['w' => 52, 'h' => 70], 'L' => ['w' => 55, 'h' => 72], 'XL' => ['w' => 58, 'h' => 74]];
                @endphp
                @foreach($guide as $s => $dims)
                <div @click="selectedSize = '{{ $s }}'; showSizeGuide = false" 
                     :class="selectedSize === '{{ $s }}' ? 'bg-indigo-600 text-white scale-[1.02] shadow-lg' : 'bg-gray-50 dark:bg-gray-800/50'"
                     class="grid grid-cols-3 gap-4 p-6 rounded-2xl font-black cursor-pointer transition-all duration-300">
                    <div class="flex items-center gap-2"><span class="text-xl">{{ $s }}</span></div>
                    <div class="text-lg opacity-80">{{ $dims['w'] }} سم</div>
                    <div class="text-lg opacity-80">{{ $dims['h'] }} سم</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
window.runAI = async function(input) {
    const alpineData = Alpine.$data(document.getElementById('product-root'));
    if (!input.files || !input.files[0]) return;
    alpineData.isProcessing = true;
    setTimeout(() => {
        alpineData.generatedTryOnImage = "{{ asset('storage/ai-result.png') }}";
        alpineData.isProcessing = false;
    }, 3000); 
};

function addToCart(product) {
    const root = Alpine.$data(document.getElementById('product-root'));
    const size = root.selectedSize;
    const color = root.selectedColor;
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    cart.push({ ...product, chosen_size: size, chosen_color: color, qty: 1 });
    localStorage.setItem('cart', JSON.stringify(cart));
    window.dispatchEvent(new CustomEvent('refresh-cart'));

    Swal.fire({
        toast: true,
        position: 'top-end',
        icon: 'success',
        title: 'تمت الإضافة للسلة',
        text: `مقاس ${size} ولون ${color} مضاف بنجاح`,
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
    });
}
</script>
@endsection