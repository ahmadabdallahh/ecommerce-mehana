@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-12 px-6 text-right" x-data="productForm()">
    <h2 class="text-3xl font-black mb-8 dark:text-white">إضافة منتج جديد لـ <span class="text-indigo-600">ELITE.</span></h2>
    
    @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-800 p-6 rounded-[2rem] mb-8">
            <ul class="list-disc list-inside text-red-600 dark:text-red-400 font-bold text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @csrf
        
        <div class="space-y-6">
            <div class="bg-white dark:bg-gray-900 p-6 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800">
                <label class="block mb-4 font-bold dark:text-gray-300">صورة المنتج الأساسية</label>
                <div class="relative group h-64 bg-gray-50 dark:bg-gray-800 rounded-3xl border-2 border-dashed border-gray-200 dark:border-gray-700 flex items-center justify-center overflow-hidden">
                    <input type="file" name="image" class="absolute inset-0 opacity-0 cursor-pointer z-10" @change="previewImage">
                    <template x-if="!imagePreview">
                        <div class="text-center">
                            <span class="text-4xl">📸</span>
                            <p class="text-xs text-gray-400 mt-2 font-bold">اضغط لرفع الصورة</p>
                        </div>
                    </template>
                    <template x-if="imagePreview">
                        <img :src="imagePreview" class="w-full h-full object-cover">
                    </template>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-900 p-6 rounded-[2rem] shadow-sm border border-gray-100 dark:border-gray-800">
                <label class="flex items-center gap-3 cursor-pointer">
                    <input type="checkbox" name="is_ai_enabled" value="1" class="w-5 h-5 rounded-lg text-indigo-600">
                    <span class="font-bold dark:text-gray-300">تفعيل دعم الـ AI ✨</span>
                </label>
            </div>
        </div>

        <div class="md:col-span-2 space-y-6">
            <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-800">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block mb-2 font-bold dark:text-gray-300">اسم المنتج</label>
                        <input type="text" name="name" value="{{ old('name') }}" required class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white border-none">
                    </div>
                    <div>
                        <label class="block mb-2 font-bold dark:text-gray-300">السعر ($)</label>
                        <input type="number" name="price" step="0.01" value="{{ old('price') }}" required class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white border-none">
                    </div>
                </div>

                <div class="mb-6 text-right">
                    <label class="block mb-2 font-bold dark:text-gray-300">الألوان المتاحة</label>
                    <div class="flex flex-wrap gap-2 mb-3">
                        <template x-for="(color, index) in colors" :key="index">
                            <div class="flex items-center gap-2 bg-gray-100 dark:bg-gray-800 px-3 py-1 rounded-full border border-gray-200 dark:border-gray-700">
                                <span :style="'background-color:' + color" class="w-3 h-3 rounded-full"></span>
                                <input type="hidden" name="colors[]" :value="color">
                                <button type="button" @click="colors.splice(index, 1)" class="text-red-500 font-black text-xs">×</button>
                            </div>
                        </template>
                    </div>
                    <input type="color" @change="addColor($el.value)" class="w-12 h-12 rounded-xl cursor-pointer p-1 bg-white border border-gray-200">
                </div>

                <div class="mb-6">
                    <label class="block mb-4 font-bold dark:text-gray-300">المقاسات المتاحة</label>
                    <div class="flex flex-wrap gap-3">
                        <template x-for="size in availableSizes" :key="size">
                            <button 
                                type="button" 
                                @click="toggleSize(size)"
                                :class="sizes.includes(size) 
                                    ? 'bg-indigo-600 text-white border-indigo-600 shadow-md scale-105' 
                                    : 'bg-gray-50 dark:bg-gray-800 text-gray-400 border-gray-100 dark:border-gray-700'"
                                class="w-12 h-12 rounded-xl border-2 font-black text-xs transition-all duration-200 flex items-center justify-center hover:border-indigo-400"
                            >
                                <span x-text="size"></span>
                                <template x-if="sizes.includes(size)">
                                    <input type="hidden" name="sizes[]" :value="size">
                                </template>
                            </button>
                        </template>
                    </div>

                    <div class="mt-4 flex gap-2 items-center">
                        <input type="text" x-model="newSize" @keydown.enter.prevent="addCustomSize" placeholder="مقاس آخر..." class="px-4 py-2 bg-gray-50 dark:bg-gray-800 rounded-xl outline-none border-none text-[10px] dark:text-white w-24">
                        <button type="button" @click="addCustomSize" class="text-indigo-600 font-bold text-[10px]">+ إضافة</button>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block mb-2 font-bold dark:text-gray-300">الوصف</label>
                    <textarea name="description" rows="5" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 rounded-2xl outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white border-none">{{ old('description') }}</textarea>
                </div>

                <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-3xl font-black text-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-200 dark:shadow-none">
                    نشر المنتج في المتجر 🚀
                </button>
            </div>
        </div>
    </form>
</div>

<script>
function productForm() {
    return {
        imagePreview: null,
        colors: [],
        sizes: [],
        availableSizes: ['S', 'M', 'L', 'XL', 'XXL', '37', '38', '39', '40', '41', '42'],
        newSize: '',
        previewImage(e) {
            const file = e.target.files[0];
            if (file) { this.imagePreview = URL.createObjectURL(file); }
        },
        addColor(val) {
            if(!this.colors.includes(val)) { this.colors.push(val); }
        },
        toggleSize(size) {
            if (this.sizes.includes(size)) {
                this.sizes.splice(this.sizes.indexOf(size), 1);
            } else {
                this.sizes.push(size);
            }
        },
        addCustomSize() {
            let s = this.newSize.trim().toUpperCase();
            if(s) {
                if(!this.availableSizes.includes(s)) this.availableSizes.push(s);
                if(!this.sizes.includes(s)) this.sizes.push(s);
                this.newSize = '';
            }
        }
    }
}
</script>
@endsection