<?php

namespace App\Http\Controllers\Auth;
use App\Http\Requests\Auth\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Inertia\Inertia;

class AdminLoginController extends Controller
{
    public function __construct() {
        
    }

    public function login() {
        return Inertia::render('Auth/AdminLogin', [
            "user_type" => "Admin",
            "page_name" => "Login"
          ]);
    }

    public function authenticate(AdminLoginRequest $request) {

        $request->authenticate();
        $request->session()->regenerate();
        return redirect()->intended(route('admin.dashboard', absolute: false));
    }

    public function logout(Request $request): RedirectResponse {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
