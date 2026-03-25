@extends('layouts.app')

@section('title', 'فلسفتنا | ELITE')

@section('content')
<div class="min-h-screen py-20 px-6 overflow-hidden bg-[#fafafa] dark:bg-gray-950 transition-colors duration-500">
    
    <div class="max-w-7xl mx-auto text-center mb-32 animate-fade-in">
        <span class="text-indigo-600 font-black text-xs uppercase tracking-[0.3em] mb-4 block italic">The Elite Standard</span>
        <h1 class="text-6xl md:text-8xl font-black text-gray-900 dark:text-white tracking-tighter mb-8">
            نصيغ الأناقة <br> 
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">بمعايير النخبة.</span>
        </h1>
        <p class="max-w-3xl mx-auto text-gray-500 dark:text-gray-400 text-lg md:text-xl leading-relaxed font-bold">
            في ELITE، لا نصمم مجرد أزياء؛ نحن نبتكر تجارب بصرية تعيد تعريف مفهوم الفخامة العصرية. كل قطعة هي بيان فني صُمم خصيصاً لمن لا يقبلون بأقل من الكمال.
        </p>
    </div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 mb-32">
        <div class="bg-white dark:bg-gray-900 p-12 rounded-[3rem] border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all group text-center">
            <h3 class="text-5xl font-black text-indigo-600 mb-2">+10k</h3>
            <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">عضو في مجتمع النخبة</p>
        </div>
        <div class="bg-indigo-600 p-12 rounded-[3rem] shadow-2xl shadow-indigo-200 dark:shadow-none group text-center">
            <h3 class="text-5xl font-black text-white mb-2">100%</h3>
            <p class="text-indigo-200 font-bold uppercase tracking-widest text-[10px]">حرفية إيطالية لا تضاهى</p>
        </div>
        <div class="bg-white dark:bg-gray-900 p-12 rounded-[3rem] border border-gray-100 dark:border-gray-800 shadow-sm hover:shadow-xl transition-all text-center">
            <h3 class="text-5xl font-black text-indigo-600 mb-2">Prestige</h3>
            <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">خدمة تليق بمكانتك</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto flex flex-col md:flex-row items-center gap-20 mb-32" dir="rtl">
        
        <div class="flex-1 relative animate-fade-in [animation-delay:200ms] group" 
             x-data="{ mouseX: 0, mouseY: 0 }" 
             @mousemove="mouseX = $event.clientX; mouseY = $event.clientY">
            
            <div class="absolute -top-10 -left-10 w-40 h-40 bg-indigo-100 dark:bg-indigo-900/20 rounded-full blur-3xl transition-transform group-hover:scale-125 duration-1000"></div>
            
            <div class="relative h-[550px] rounded-[4rem] overflow-hidden shadow-2xl border border-gray-100 dark:border-gray-800 bg-white dark:bg-gray-900 transition-all duration-700 ease-in-out group-hover:border-indigo-200 dark:group-hover:border-indigo-500/30">
                
                <div class="absolute inset-0 flex items-center justify-center text-indigo-600/5 dark:text-indigo-400/5 font-black italic select-none pointer-events-none transition-transform duration-[2s] ease-out"
                     :style="`transform: translate(${(mouseX - window.innerWidth/2) / 40}px, ${(mouseY - window.innerHeight/2) / 40}px) scale(1.1);` text-size='500px'">
                    E
                </div>

                <div class="absolute inset-0 flex items-center justify-center z-20">
                    <div class="text-[200px] font-black italic text-indigo-600 dark:text-indigo-500 transition-transform duration-700 ease-out select-none drop-shadow-2xl"
                         :style="`transform: translate(${(mouseX - window.innerWidth/2) / 25}px, ${(mouseY - window.innerHeight/2) / 25}px) rotate(${(mouseX - window.innerWidth/2) / 80}deg);` shadow-color='rgba(79, 70, 229, 0.2)'">
                        E
                        <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-24 h-2 bg-indigo-600/20 blur-xl rounded-full"></div>
                    </div>
                </div>

                <div class="absolute inset-0 bg-gradient-to-tr from-white/40 via-transparent to-transparent dark:from-black/40 z-30 pointer-events-none"></div>
                
                <div class="absolute bottom-12 left-12 z-40 transition-all duration-500 group-hover:translate-x-2">
                    <div class="px-6 py-3 bg-white/80 dark:bg-gray-800/80 backdrop-blur-xl rounded-2xl border border-gray-100 dark:border-gray-700 shadow-xl flex items-center gap-3">
                        <span class="w-2 h-2 bg-indigo-600 rounded-full animate-ping"></span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400">Elite Aesthetic Lab</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex-1 space-y-10 text-right animate-fade-in [animation-delay:400ms]">
            <div class="space-y-4">
                <h2 class="text-5xl font-black text-gray-900 dark:text-white tracking-tighter">فلسفة التميز</h2>
                <div class="w-20 h-1.5 bg-indigo-600 rounded-full"></div>
            </div>
            
            <p class="text-gray-500 dark:text-gray-400 leading-loose font-medium text-lg">
                رؤيتنا تتجاوز حدود التجارة التقليدية. نحن نسعى لخلق عالم تلتقي فيه التكنولوجيا المتقدمة بالفن اليدوي الرفيع. في ELITE، نؤمن أن الملابس هي لغة بصرية تحكي قصتك الفريدة للعالم، لذا نولي اهتماماً فائقاً بكل غرزة وكل تفصيلة تقنية.
            </p>

            <ul class="space-y-6">
                <li class="flex items-center gap-6 group">
                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-gray-900 dark:text-white">جودة بلا تنازلات</span>
                        <span class="text-sm text-gray-400 font-bold">انتقاء دقيق لأجود المنسوجات العالمية بمعايير تقنية.</span>
                    </div>
                </li>
                <li class="flex items-center gap-6 group">
                    <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center shadow-sm group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="font-black text-gray-900 dark:text-white">حصرية النخبة</span>
                        <span class="text-sm text-gray-400 font-bold">إصدارات محدودة تضمن لك التفرد الكامل في كل إطلالة.</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</div>

<style>
    .animate-fade-in {
        animation: fadeIn 1.2s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection