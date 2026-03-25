@extends('layouts.app')

@section('title', 'إتمام الطلب | ELITE')

@section('content')
<div class="max-w-7xl mx-auto px-6 py-16 transition-colors duration-500 text-right" x-data="checkoutPage()">
    <div class="flex flex-col lg:flex-row-reverse gap-16">
        
        <div class="flex-1 space-y-10">
            <div>
                <h2 class="text-4xl font-black text-gray-900 dark:text-white tracking-tighter mb-2">إتمام الطلب<span class="text-indigo-600">.</span></h2>
                <p class="text-gray-400 dark:text-gray-500 font-bold">يرجى إدخال بيانات الشحن واختيار طريقة الدفع</p>
            </div>

           <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-800 space-y-6">
    <h3 class="text-xl font-black text-gray-900 dark:text-white flex items-center gap-3 justify-end">
        عنوان الشحن
        <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
    </h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <input type="text" x-model="address.city" placeholder="المدينة" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl font-bold text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500" :class="errors.city ? 'ring-2 ring-red-500' : ''">
            <p x-show="errors.city" x-text="errors.city" class="text-red-500 text-xs mt-1 font-bold"></p>
        </div>
        <div>
            <input type="text" x-model="address.street" placeholder="الحي / الشارع" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl font-bold text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500" :class="errors.street ? 'ring-2 ring-red-500' : ''">
            <p x-show="errors.street" x-text="errors.street" class="text-red-500 text-xs mt-1 font-bold"></p>
        </div>
    </div>
    <div>
        <textarea x-model="address.details" placeholder="تفاصيل إضافية (رقم الشقة / علامة مميزة)" class="w-full px-6 py-4 bg-gray-50 dark:bg-gray-800 border-none rounded-2xl font-bold text-gray-900 dark:text-white outline-none focus:ring-2 focus:ring-indigo-500 h-32" :class="errors.details ? 'ring-2 ring-red-500' : ''"></textarea>
        <p x-show="errors.details" x-text="errors.details" class="text-red-500 text-xs mt-1 font-bold"></p>
    </div>
</div>

            <div class="bg-white dark:bg-gray-900 p-8 rounded-[2.5rem] shadow-sm border border-gray-100 dark:border-gray-800 space-y-6">
                <h3 class="text-xl font-black text-gray-900 dark:text-white flex items-center gap-3 justify-end">
                    طريقة الدفع
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <label class="relative flex items-center justify-between p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl cursor-pointer border-2 border-transparent hover:border-indigo-600 transition-all">
                        <input type="radio" name="payment" class="hidden" checked>
                        <div class="text-right">
                            <span class="block font-black text-gray-900 dark:text-white">الدفع عند الاستلام</span>
                            <span class="text-[10px] text-gray-400 font-bold">رسوم إضافية $0</span>
                        </div>
                        <span class="text-2xl">💵</span>
                    </label>

                    <label class="relative flex items-center justify-between p-6 bg-gray-50 dark:bg-gray-800 rounded-2xl cursor-pointer border-2 border-transparent hover:border-indigo-600 transition-all opacity-50">
                        <input type="radio" name="payment" class="hidden" disabled>
                        <div class="text-right">
                            <span class="block font-black text-gray-900 dark:text-white">بطاقة ائتمان</span>
                            <span class="text-[10px] text-indigo-600 font-bold uppercase">قريباً</span>
                        </div>
                        <span class="text-2xl">💳</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="w-full lg:w-[400px]">
            <div class="bg-white dark:bg-gray-900 p-8 rounded-[3rem] shadow-xl border border-gray-100 dark:border-gray-800 sticky top-32">
                <h3 class="text-xl font-black text-gray-900 dark:text-white mb-8 border-b pb-4 border-gray-50 dark:border-gray-800">ملخص الحقيبة</h3>
                
                <div class="space-y-6 mb-10 max-h-96 overflow-y-auto pr-2">
                    <template x-for="item in cartItems">
                        <div class="flex gap-4 items-center flex-row-reverse">
                            <div class="w-16 h-20 bg-gray-100 dark:bg-gray-800 rounded-2xl overflow-hidden flex-shrink-0">
                                <img :src="'/storage/' + item.image" class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1 text-right">
                                <h4 class="font-bold text-sm text-gray-900 dark:text-white" x-text="item.name"></h4>
                                <p class="text-[10px] text-gray-400 font-bold" x-text="'المقاس: ' + item.chosen_size"></p>
                                <span class="font-black text-indigo-600 text-sm" x-text="'$' + item.price"></span>
                            </div>
                        </div>
                    </template>
                </div>

                <div class="space-y-4 border-t pt-6 border-gray-50 dark:border-gray-800">
                    <div class="flex justify-between font-bold text-gray-400">
                        <span x-text="'$' + cartTotal"></span>
                        <span>المجموع</span>
                    </div>
                    <div class="flex justify-between font-bold text-green-500">
                        <span>مجاني</span>
                        <span>الشحن</span>
                    </div>
                    <div class="flex justify-between items-center pt-4">
                        <span class="text-3xl font-black text-gray-900 dark:text-white tracking-tighter" x-text="'$' + cartTotal"></span>
                        <span class="font-black text-gray-900 dark:text-white text-lg">الإجمالي</span>
                    </div>
                </div>

                <button @click.prevent="submitOrder()" class="w-full bg-indigo-600 text-white py-6 rounded-2xl font-black text-lg mt-10 hover:bg-indigo-700 transition shadow-xl active:scale-95 flex items-center justify-center gap-2">
                    <span x-show="!loading">تأكيد الطلب الآن</span>
                    <svg x-show="loading" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function checkoutPage() {
    return {
        cartItems: JSON.parse(localStorage.getItem('cart')) || [],
        cartTotal: 0,
        address: { city: '', street: '', details: '' },
        errors: {},
        loading: false,
        
        init() {
            this.cartTotal = this.cartItems.reduce((sum, item) => sum + parseFloat(item.price), 0);
            if(this.cartItems.length === 0) {
                window.location.href = '/shop';
            }
        },

        // استبدل الـ submitOrder القديمة بهذا الكود المعدل:
        async submitOrder() {
            this.errors = {};
            this.loading = true;

            if(!this.address.city.trim()) this.errors.city = "المدينة مطلوبة لشحن طلبك";
            if(!this.address.street.trim()) this.errors.street = "برجاء كتابة اسم الشارع أو الحي";
            if(!this.address.details.trim()) this.errors.details = "برجاء إضافة أي تفاصيل للوصول إليك";

            if(Object.keys(this.errors).length > 0) {
                this.loading = false;
                return;
            }

            try {
                const response = await fetch('/place-order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        city: this.address.city,
                        street: this.address.street,
                        details: this.address.details,
                        items: this.cartItems,
                        total_price: this.cartTotal
                    })
                });

                const data = await response.json(); 

                if(response.ok && data.success) {
                    Swal.fire({
                        title: 'تم تسجيل طلبك!',
                        text: 'سيصلك مندوبنا في أقرب وقت.',
                        icon: 'success',
                        confirmButtonText: 'ممتاز',
                        customClass: { popup: 'rounded-[2rem] font-bold' }
                    }).then(() => {
                        localStorage.removeItem('cart');
                        window.location.href = '/'; 
                    });
                } else {
                    // هنا السيرفر هيقولك "ليه" الأوردر ما وصلش (مثلاً مشكلة في الداتا بيز)
                    alert(data.message || 'حدث خطأ في معالجة الطلب');
                }
            } catch (error) {
                console.error(error);
                alert('حدث خطأ في الاتصال بالسيرفر');
            } finally {
                this.loading = false;
            }
        }
    }
}
</script>
@endsection