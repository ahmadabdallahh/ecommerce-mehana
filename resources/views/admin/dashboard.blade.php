@extends('layouts.app')

@section('title', 'لوحة التحكم الشاملة | ELITE')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-12 text-right transition-all" dir="rtl">
    
    <div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-6 mb-12">
        <div>
            <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter">لوحة التحكم<span class="text-indigo-600">.</span></h2>
            <p class="text-gray-400 dark:text-gray-500 font-bold mt-2">إدارة شاملة للمنتجات والطلبات</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="bg-indigo-600 text-white px-8 py-4 rounded-[1.5rem] font-black text-sm hover:bg-indigo-700 transition shadow-xl shadow-indigo-200 dark:shadow-none">
            + إضافة منتج جديد
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
        <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-sm transition-transform hover:scale-105">
            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block mb-2">إجمالي المبيعات</span>
            <span class="text-3xl font-black text-green-500 tracking-tighter">${{ number_format($totalRevenue, 2) }}</span>
        </div>
        <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-sm transition-transform hover:scale-105">
            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block mb-2">عدد الطلبات</span>
            <span class="text-3xl font-black text-indigo-600 tracking-tighter">{{ $orders->count() }}</span>
        </div>
        <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-sm transition-transform hover:scale-105">
            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block mb-2">إجمالي المنتجات</span>
            <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter">{{ $totalProducts }}</span>
        </div>
        <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-sm transition-transform hover:scale-105">
            <span class="text-[10px] font-black uppercase text-gray-400 tracking-widest block mb-2">حالة المتجر</span>
            <span class="text-xl font-black text-green-500 flex items-center gap-2">نشط الآن <span class="relative h-3 w-3"><span class="animate-ping absolute h-full w-full rounded-full bg-green-400 opacity-75"></span><span class="relative rounded-full h-3 w-3 bg-green-500"></span></span></span>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-[3rem] border border-gray-100 dark:border-gray-800 overflow-hidden shadow-2xl mb-16">
        <div class="p-8 border-b border-gray-50 dark:border-gray-800 flex justify-between items-center bg-gray-50/30 dark:bg-gray-800/20">
            <h3 class="text-xl font-black text-gray-900 dark:text-white">إدارة الطلبات الحديثة</h3>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50">
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">رقم الطلب</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">العميل وبيانات التواصل</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">الإجمالي</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @forelse($orders as $order)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-all group">
                        <td class="px-8 py-6 font-black text-gray-400 text-xs">#{{ $order->id }}</td>
                        <td class="px-8 py-6">
                            <div class="font-black text-gray-900 dark:text-white text-sm leading-none mb-1">{{ $order->user->name ?? 'عميل زائر' }}</div>
                            <div class="text-[11px] text-gray-500 dark:text-gray-400 font-bold mb-1 italic">{{ $order->user->email ?? 'no-email@elite.com' }}</div>
                            <div class="text-indigo-600 dark:text-indigo-400 font-black text-[10px] tracking-widest"> {{ $order->phone ?? 'بدون هاتف' }}</div>
                        </td>
                        <td class="px-8 py-6 text-center font-black text-gray-900 dark:text-white text-lg tracking-tighter">${{ number_format($order->total_price, 2) }}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3 justify-center">
                                @if($order->status == 'pending')
                                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST" id="shipped-form-{{ $order->id }}">
                                        @csrf @method('PATCH')
                                        <button type="button" onclick="confirmStatusUpdate({{ $order->id }})" class="bg-amber-50 dark:bg-amber-900/20 text-amber-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-amber-100 border border-amber-100 dark:border-amber-900/50">تأكيد وشحن</button>
                                    </form>
                                @else
                                    <span class="bg-green-50 dark:bg-green-900/20 text-green-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase border border-green-100 dark:border-green-900/50">تم الشحن</span>
                                @endif
                                <button type="button" onclick="handleDelete('{{ route('admin.orders.destroy', $order->id) }}', 'هذا الطلب')" class="p-2 text-red-400 hover:text-red-600 transition-colors">🗑️</button>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="4" class="px-8 py-20 text-center text-gray-400 font-black italic">لا توجد طلبات حالياً</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="bg-white dark:bg-gray-900 rounded-[3rem] border border-gray-100 dark:border-gray-800 overflow-hidden shadow-2xl">
        <div class="p-8 border-b border-gray-50 dark:border-gray-800 flex justify-between items-center bg-gray-50/30 dark:bg-gray-800/20">
            <h3 class="text-xl font-black text-gray-900 dark:text-white">إدارة قائمة المنتجات</h3>
            <span class="bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest">{{ $products->count() }} منتج إجمالي</span>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-50 dark:bg-gray-800/50">
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">المنتج</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest">السعر</th>
                        <th class="px-8 py-5 text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 dark:divide-gray-800">
                    @foreach($products as $product)
                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-all group">
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-4 justify-start">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-14 h-14 rounded-2xl object-cover border border-gray-100 dark:border-gray-800 shadow-sm transition-transform group-hover:scale-110">
                                <span class="font-black text-gray-900 dark:text-white text-sm">{{ $product->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6 font-black text-gray-900 dark:text-white text-base">${{ number_format($product->price, 2) }}</td>
                        <td class="px-8 py-6">
                            <div class="flex items-center gap-3 justify-center">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 px-4 py-2 rounded-xl text-[10px] font-black uppercase hover:bg-indigo-100 border border-indigo-100 dark:border-indigo-900/50">📝 تعديل</a>
                                <button type="button" onclick="handleDelete('{{ route('admin.products.destroy', $product->id) }}', 'هذا المنتج')" class="p-2 text-red-400 hover:text-red-600 transition-colors">🗑️</button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    const isDark = document.documentElement.classList.contains('dark');
    const swalConfig = {
        background: isDark ? '#111827' : '#fff',
        color: isDark ? '#fff' : '#000',
        customClass: {
            popup: 'rounded-[2.5rem] border border-gray-100 dark:border-gray-800 shadow-2xl font-bold',
            confirmButton: 'rounded-xl px-6 py-3 font-black transition-all hover:scale-105',
            cancelButton: 'rounded-xl px-6 py-3 font-black transition-all hover:scale-105'
        }
    };

    function handleDelete(url, item) {
        Swal.fire({
            ...swalConfig,
            title: 'هل أنت متأكد؟',
            text: `سيتم حذف ${item} نهائياً!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            cancelButtonColor: '#ef4444',
            confirmButtonText: 'نعم، احذف',
            cancelButtonText: 'إلغاء'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.action = url;
                form.method = 'POST';
                form.innerHTML = `@csrf @method('DELETE')`;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

    function confirmStatusUpdate(id) {
        Swal.fire({
            ...swalConfig,
            title: 'تأكيد الشحن؟',
            text: "هل تريد تحديث حالة الطلب إلى (تم الشحن)؟",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#4f46e5',
            confirmButtonText: 'تأكيد وشحن 🚀',
            cancelButtonText: 'ليس الآن'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('shipped-form-' + id).submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            ...swalConfig,
            title: 'تمت العملية! 🎉',
            text: "{{ session('success') }}",
            icon: 'success',
            confirmButtonColor: '#4f46e5',
            timer: 3000
        });
    @endif
</script>
@endsection