@extends('layouts.app')

@section('title', 'تسجيل الدخول | ELITE')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-[#fafafa] dark:bg-gray-950 py-12 px-6 transition-colors duration-500 text-right">
    <div class="max-w-md w-full bg-white dark:bg-gray-900 rounded-[3rem] shadow-2xl p-10 border border-gray-100 dark:border-gray-800 animate-fade-in">
        
        <div class="mb-10">
            <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-2 tracking-tighter">مرحباً بك مجدداً<span class="text-indigo-600">.</span></h2>
            <p class="text-gray-400 dark:text-gray-500 font-bold text-sm">سجل دخولك لإتمام عملية الشراء</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 rounded-2xl">
                @foreach ($errors->all() as $error)
                    <p class="text-red-600 dark:text-red-400 text-xs font-bold">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-2 mr-2 tracking-widest">الاسم الكامل</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="admin" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-2 mr-2 tracking-widest">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="admin@elite.com" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <div>
                <div class="flex justify-between items-center mb-2 px-2">
                    <label class="text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 tracking-widest">كلمة المرور</label>
                    <a href="#" class="text-[10px] font-bold text-indigo-600 hover:text-indigo-400">نسيت كلمة المرور؟</a>
                </div>
                <input type="password" name="password" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <button type="submit" 
                    class="w-full bg-gray-900 dark:bg-indigo-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-indigo-600 dark:hover:bg-indigo-700 transition shadow-xl active:scale-95 flex items-center justify-center gap-2 mt-8">
                تسجيل الدخول
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
            </button>

            <p class="text-center text-sm font-bold text-gray-400 dark:text-gray-500 mt-8">
                ليس لديك حساب؟ 
                <a href="{{ route('register') }}" class="text-indigo-600 hover:text-indigo-400 transition-colors">أنشئ حساباً جديداً</a>
            </p>
        </form>
    </div>
</div>
@endsection