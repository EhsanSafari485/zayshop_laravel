<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\auth\loginRequest;
use App\Http\Requests\auth\registerRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class authController extends Controller
{
    // فرم ثبت‌نام
    public function showRegisterForm() {
        return view('auth.register');
    }

    // پردازش ثبت‌نام
    public function register(registerRequest $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        session()->flash('welcome', 'خوش آمدید ' . Auth::user()->name . ' عزیز!');
        return redirect()->route('Home.index');
    }

    // فرم ورود
    public function showLoginForm() {
        return view('auth.login');
    }

    // پردازش ورود

    public function login(loginRequest $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            if ($request->ajax()) {
                return response()->json(['success' => true]);
            }

            session()->flash('welcome', 'خوش آمدید ' . Auth::user()->name . ' عزیز!');
            return redirect()->route('Home.index');
        } else {
            if ($request->ajax()) {
                return response()->json([
                    'message' => 'ایمیل یا رمز عبور اشتباه است.',
                ], 422);
            }
        }
    }


    // خروج از حساب
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Cookie::queue(Cookie::forget('remember_web_' . Auth::getDefaultDriver()));
        return redirect()->route('Home.index');
    }
}
