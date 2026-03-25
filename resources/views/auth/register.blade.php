@extends('layouts.app')

@section('title', 'إنشاء حساب جديد | ELITE')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-[#fafafa] dark:bg-gray-950 py-12 px-6 transition-colors duration-500 text-right">
    <div class="max-w-md w-full bg-white dark:bg-gray-900 rounded-[3rem] shadow-2xl p-10 border border-gray-100 dark:border-gray-800 animate-fade-in">
        
        <div class="mb-10">
            <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-2 tracking-tighter">انضم إلينا<span class="text-indigo-600">.</span></h2>
            <p class="text-gray-400 dark:text-gray-500 font-bold text-sm">ابدأ رحلتك في عالم الموضة الذكية</p>
        </div>

        @if ($errors->any())
            <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 rounded-2xl">
                @foreach ($errors->all() as $error)
                    <p class="text-red-600 dark:text-red-400 text-[11px] font-black">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-5">
            @csrf
            
            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-2 mr-2 tracking-widest text-right">الأسم بالكامل</label>
                <input type="text" name="name" value="{{ old('name') }}" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-2 mr-2 tracking-widest text-right">البريد الإلكتروني</label>
                <input type="email" name="email" value="{{ old('email') }}" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-2 mr-2 tracking-widest text-right">كلمة المرور</label>
                <input type="password" name="password" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <div>
                <label class="block text-[10px] font-black uppercase text-gray-400 dark:text-gray-500 mb-2 mr-2 tracking-widest text-right">تأكيد كلمة المرور</label>
                <input type="password" name="password_confirmation" required 
                       class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500 font-bold text-gray-900 dark:text-white transition-all outline-none">
            </div>

            <button type="submit" 
                    class="w-full bg-gray-900 dark:bg-indigo-600 text-white py-5 rounded-2xl font-black text-lg hover:bg-indigo-600 dark:hover:bg-indigo-700 transition shadow-xl active:scale-95 flex items-center justify-center gap-2 mt-6">
                إنشاء حساب
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
            </button>

            <p class="text-center text-sm font-bold text-gray-400 dark:text-gray-500 mt-6">
                لديك حساب بالفعل؟ 
                <a href="{{ route('login') }}" class="text-indigo-600 hover:text-indigo-400 transition-colors underline decoration-2">سجل دخولك</a>
            </p>
        </form>
    </div>
</div>
@endsection