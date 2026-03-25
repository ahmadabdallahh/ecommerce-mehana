<!DOCTYPE html>
<html lang="ar" dir="rtl" x-data="globalCart()" :class="darkMode ? 'dark' : ''">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'ELITE | المتجر الذكي')</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon-light.png') }}">

<link rel="icon" type="image/png" href="{{ asset('favicon-dark.png') }}" media="(prefers-color-scheme: dark)">
    
    <title>@yield('title', 'ELITE | المتجر الذكي')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: { 'cairo': ['Cairo', 'sans-serif'] },
                    colors: {
                        indigo: { 50: '#f5f7ff', 100: '#ebf0fe', 200: '#ced9fd', 300: '#adc0fc', 400: '#8da7fa', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca', 800: '#3730a3', 900: '#312e81', 950: '#1e1b4b' }
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Cairo', sans-serif; transition: background-color 0.5s ease; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #4f46e5; border-radius: 20px; border: 3px solid transparent; background-clip: content-box; }
        .dark ::-webkit-scrollbar-track { background: #0f172a; }

        /* Intro Animations */
        @keyframes loading-bar {
            0% { width: 0%; transform: translateX(-100%); }
            100% { width: 100%; transform: translateX(0); }
        }
        .animate-loading { animation: loading-bar 2.5s cubic-bezier(0.65, 0, 0.35, 1) forwards; }
        
        /* Layout Transitions */
        .fade-enter { opacity: 0; transform: translateY(10px); }
        .fade-enter-active { opacity: 1; transform: translateY(0); transition: all 0.5s ease; }
    </style>
</head>

<body class="bg-[#fafafa] dark:bg-gray-950 text-gray-900 dark:text-gray-100 min-h-screen overflow-x-hidden">

    <div x-data="{ loading: true }" 
         x-init="setTimeout(() => { loading = false; try { $refs.audio.play(); } catch(e){} }, 2500)" 
         x-show="loading" 
         x-transition:leave="transition ease-in-out duration-1000" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-110"
         class="fixed inset-0 z-[9999] bg-white dark:bg-gray-950 flex items-center justify-center overflow-hidden">
        
        <audio x-ref="audio" src="https://www.soundjay.com/buttons/sounds/button-20.mp3" preload="auto"></audio>

        <div class="relative flex flex-col items-center">
            <div class="relative group">
                <div class="absolute -inset-4 bg-indigo-500/20 rounded-[3rem] blur-2xl group-hover:bg-indigo-500/40 transition duration-1000 animate-pulse"></div>
                
                <div class="relative w-28 h-28 bg-indigo-600 rounded-[2.5rem] flex items-center justify-center text-white text-6xl font-black shadow-[0_20px_50px_rgba(79,70,229,0.3)]">
                    E
                </div>
                
                <div class="absolute inset-0 border-2 border-indigo-600/30 rounded-[2.5rem] animate-ping"></div>
                <div class="absolute -inset-8 border border-indigo-500/5 rounded-[4rem] animate-[spin_15s_linear_infinite]"></div>
            </div>

            <div class="mt-16 text-center space-y-6">
                <div class="space-y-2">
                    <h2 class="text-gray-900 dark:text-white font-black tracking-[0.8em] text-sm uppercase animate-pulse">
                        Elite Standard
                    </h2>
                    <p class="text-[10px] text-indigo-500 font-bold tracking-widest uppercase">Experience Modernity</p>
                </div>
                
                <div class="w-48 h-[3px] bg-gray-100 dark:bg-gray-800/50 rounded-full mx-auto overflow-hidden">
                    <div class="h-full bg-indigo-600 animate-loading"></div>
                </div>
            </div>
        </div>
    </div>

    <nav class="bg-white/80 dark:bg-gray-900/80 backdrop-blur-xl border-b border-gray-100 dark:border-gray-800 sticky top-0 z-[100] transition-all duration-500 h-24 flex items-center">
        <div class="max-w-7xl mx-auto px-8 w-full">
            <div class="flex justify-between items-center">
                <a href="{{ route('shop') }}" class="group flex items-center gap-3">
                    <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl font-black shadow-lg shadow-indigo-200 dark:shadow-none group-hover:rotate-12 transition-transform duration-300">
                        E
                    </div>
                    <div class="flex flex-col leading-none">
                        <span class="text-2xl font-black tracking-tighter text-gray-900 dark:text-white">ELITE<span class="text-indigo-600">.</span></span>
                        <span class="text-[9px] font-bold text-gray-400 dark:text-gray-500 tracking-[0.2em] uppercase">Premium Shop</span>
                    </div>
                </a>

                @if(!request()->routeIs('login') && !request()->routeIs('register'))
                    <div class="hidden md:flex items-center gap-10 font-bold text-[13px] text-gray-400 dark:text-gray-500">
                        <a href="{{ route('shop') }}" class="hover:text-indigo-600 dark:hover:text-white transition-colors relative group">
                            تسوّق الآن
                            <span class="absolute -bottom-1 right-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                        </a>
                        <a href="{{ route('about') }}" class="hover:text-indigo-600 dark:hover:text-white transition-colors relative group">
                            عن المتجر
                            <span class="absolute -bottom-1 right-0 w-0 h-0.5 bg-indigo-600 transition-all group-hover:w-full"></span>
                        </a>
                    </div>
                @endif

                <div class="flex items-center gap-5">
                    <button @click="toggleDarkMode()" class="p-3.5 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-900 dark:text-yellow-400 hover:scale-110 active:scale-95 transition-all shadow-sm">
                        <template x-if="!darkMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </template>
                        <template x-if="darkMode">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </template>
                    </button>

                    @if(!request()->routeIs('login') && !request()->routeIs('register'))
                        <button @click="$dispatch('toggle-cart')" class="relative p-3.5 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-900 dark:text-white hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition shadow-sm group">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            <span x-text="cartCount" class="absolute -top-1 -right-1 bg-indigo-600 text-white text-[10px] font-black w-5 h-5 rounded-full flex items-center justify-center border-2 border-white dark:border-gray-900 shadow-md">0</span>
                        </button>
                    @endif

                    @auth
                        <div class="relative" x-data="{ openUser: false }">
                            <button @click="openUser = !openUser" @click.outside="openUser = false" class="p-3.5 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-900 dark:text-white hover:bg-indigo-50 transition shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <div x-show="openUser" x-cloak x-transition:enter="transition duration-200" x-transition:enter-start="opacity-0 scale-95" class="absolute left-0 mt-4 w-56 bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-[2rem] shadow-2xl z-[200] overflow-hidden">
                                <div class="px-6 py-5 border-b border-gray-50 dark:border-gray-800 text-right">
                                    <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest">مرحباً بك</p>
                                    <p class="text-sm font-bold text-gray-900 dark:text-white truncate">{{ Auth::user()->name }}</p>
                                </div>
                                <div class="p-2">
                                    @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 text-sm font-bold text-gray-600 dark:text-gray-300 hover:bg-indigo-50 dark:hover:bg-indigo-900/20 rounded-xl text-right transition">لوحة التحكم</a>
                                    @endif
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full text-right px-4 py-3 text-sm font-bold text-red-500 hover:bg-red-50 dark:hover:bg-red-900/10 rounded-xl transition">تسجيل الخروج</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @else
                        @if(!request()->routeIs('login'))
                            <a href="{{ route('login') }}" class="p-3.5 bg-gray-50 dark:bg-gray-800 rounded-2xl text-gray-900 dark:text-white hover:bg-indigo-50 transition shadow-sm">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 16l-4-4m0 0l4-4m-4 4h12m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="relative z-10">
        @yield('content')
    </main>

    @if(!request()->routeIs('login') && !request()->routeIs('register'))
        <div x-show="openCart" x-cloak 
             @toggle-cart.window="openCart = !openCart" 
             @refresh-cart.window="updateCart()" 
             class="fixed inset-0 z-[150] overflow-hidden">
            
            <div x-show="openCart" x-transition.opacity @click="openCart = false" class="absolute inset-0 bg-gray-950/40 dark:bg-black/80 backdrop-blur-md"></div>
            
            <div class="fixed inset-y-0 left-0 max-w-md w-full flex">
                <div x-show="openCart" 
                     x-transition:enter="transform transition duration-700 cubic-bezier(0.16, 1, 0.3, 1)" 
                     x-transition:enter-start="-translate-x-full" 
                     x-transition:enter-end="translate-x-0" 
                     x-transition:leave="transform transition duration-500" 
                     x-transition:leave-start="translate-x-0" 
                     x-transition:leave-end="-translate-x-full" 
                     class="w-screen max-w-md bg-white dark:bg-gray-900 shadow-[50px_0_100px_rgba(0,0,0,0.1)] dark:shadow-none flex flex-col h-full">
                    
                    <div class="px-10 py-10 border-b border-gray-100 dark:border-gray-800 flex justify-between items-center bg-gray-50/20">
                        <div class="text-right">
                            <h2 class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">الحقيبة<span class="text-indigo-600">.</span></h2>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em] mt-2">Elite Bag System</p>
                        </div>
                        <button @click="openCart = false" class="w-12 h-12 flex items-center justify-center bg-white dark:bg-gray-800 rounded-2xl shadow-sm text-gray-400 hover:text-red-500 transition-all border border-gray-100 dark:border-gray-700">✕</button>
                    </div>

                    <div class="flex-1 overflow-y-auto p-10 space-y-10 custom-scrollbar">
                        <template x-for="(item, index) in cartItems" :key="index">
                            <div class="flex gap-8 group animate-fade-in relative">
                                <div class="w-28 h-36 bg-gray-100 dark:bg-gray-800 rounded-[2.5rem] overflow-hidden flex-shrink-0 shadow-sm border border-gray-50 dark:border-gray-800">
                                    <img :src="'/storage/' + item.image" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                                </div>
                                <div class="flex flex-col justify-between py-2 flex-1 text-right">
                                    <div>
                                        <h4 class="font-black text-gray-900 dark:text-white text-xl mb-2" x-text="item.name"></h4>
                                        <div class="flex gap-2 justify-end">
                                            <span class="text-[10px] font-black bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 px-4 py-1.5 rounded-full uppercase tracking-tighter" x-text="'Size: ' + item.chosen_size"></span>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-end">
                                        <span class="font-black text-2xl text-indigo-600 dark:text-indigo-400" x-text="'$' + item.price"></span>
                                        <button @click="removeItem(index)" class="text-[11px] font-black text-red-400 hover:text-red-600 transition-colors uppercase tracking-widest border-b border-red-100 dark:border-red-900/30 pb-1">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div x-show="cartItems.length === 0" class="flex flex-col items-center justify-center py-32 text-center">
                            <div class="w-24 h-24 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center text-4xl mb-6 grayscale opacity-50">🛒</div>
                            <h3 class="font-black text-gray-900 dark:text-white text-2xl mb-2">الحقيبة فارغة</h3>
                            <p class="text-sm text-gray-400 font-bold uppercase tracking-widest">Start Shopping Now</p>
                        </div>
                    </div>

                    <div class="p-10 border-t border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 shadow-[0_-20px_50px_rgba(0,0,0,0.02)]">
                        <div class="flex justify-between items-center mb-10">
                            <div class="text-right">
                                <span class="text-gray-400 font-bold block text-[10px] uppercase tracking-[0.2em] mb-1">المبلغ المطلوب</span>
                                <span class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter" x-text="'$' + cartTotal"></span>
                            </div>
                            <div class="text-left">
                                <span class="text-[10px] font-black text-indigo-600 bg-indigo-50 dark:bg-indigo-900/40 px-5 py-2 rounded-full border border-indigo-100 dark:border-indigo-800/50">FREE SHIPPING ✨</span>
                            </div>
                        </div>
                        <a href="{{ route('checkout') }}" class="w-full bg-gray-950 dark:bg-indigo-600 text-white py-7 rounded-[2.5rem] font-black text-xl hover:bg-indigo-700 dark:hover:bg-indigo-500 transition-all shadow-2xl shadow-indigo-200 dark:shadow-none flex items-center justify-center gap-3">
                            <span>إتمام الطلب الآن</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24"><path d="M17 8l4 4m0 0l-4 4m4-4H3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <script>
        function globalCart() {
            return {
                openCart: false,
                darkMode: localStorage.getItem('theme') === 'dark',
                cartItems: [],
                cartTotal: 0,
                cartCount: 0,

                init() {
                    this.updateCart();
                    // Sync with Dark Mode on Load
                    if (this.darkMode) document.documentElement.classList.add('dark');
                    else document.documentElement.classList.remove('dark');
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('theme', this.darkMode ? 'dark' : 'light');
                    if (this.darkMode) document.documentElement.classList.add('dark');
                    else document.documentElement.classList.remove('dark');
                },

                updateCart() {
                    const saved = localStorage.getItem('cart');
                    this.cartItems = saved ? JSON.parse(saved) : [];
                    this.calculateTotal();
                    this.cartCount = this.cartItems.length;
                },

                calculateTotal() {
                    this.cartTotal = this.cartItems.reduce((sum, item) => sum + parseFloat(item.price), 0).toFixed(2);
                },

                removeItem(index) {
                    this.cartItems.splice(index, 1);
                    localStorage.setItem('cart', JSON.stringify(this.cartItems));
                    this.updateCart();
                    
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });
                    Toast.fire({
                        icon: 'info',
                        title: 'تمت إزالة المنتج من الحقيبة'
                    });
                }
            }
        }
    </script>
</body>
</html>