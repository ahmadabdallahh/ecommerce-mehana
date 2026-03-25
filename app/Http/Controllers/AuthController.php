<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // --- صفحات العرض (Views) ---
    public function showRegister() {
        return view('auth.register');
    }

    public function showLogin() {
        return view('auth.login');
    }

    // --- العمليات (Actions) ---

    // عملية تسجيل الدخول (المعدلة لتشمل الاسم)
    public function login(Request $request) {
        // 1. التحقق من المدخلات الثلاثة (زي ما عملنا في الـ Blade)
        $credentials = $request->validate([
            'name'     => ['required', 'string'], // لازم يكتب "admin" زي ما في Tinker
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. محاولة الدخول بالبيانات التلاتة
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // فحص الرول: لو أدمن يروح لصفحة الطلبات
            if (Auth::user()->role === 'admin') {
                // تأكد إن الرابط ده موجود في الـ routes باسم admin.orders.index
                return redirect()->route('admin.orders.index')->with('success', 'أهلاً بك يا مدير النظام');
            }

            return redirect()->intended('/')->with('success', 'تم تسجيل الدخول بنجاح');
        }

        // 3. لو البيانات غلط (بنرجع الاسم والإيميل عشان ما يكتبهمش تاني)
        return back()->withErrors([
            'email' => 'البيانات المدخلة (الاسم أو البريد أو كلمة المرور) غير صحيحة.',
        ])->onlyInput('email', 'name');
    }

    // عملية التسجيل (كما هي)
    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'customer', 
        ]);

        Auth::login($user);
        return redirect()->intended('/')->with('success', 'أهلاً بك في إيليت!');
    }

    // عملية تسجيل الخروج
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}