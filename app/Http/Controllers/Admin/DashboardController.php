<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class DashboardController extends Controller
{
    private $auth;
    
    public function __construct() {
        $this->auth = Auth::guard('admin')->user();
    }

    public function index(Request $request) {
        
        return Inertia::render("Admin/Dashboard", [
            'admin' => $this->auth,
            'logged_in' => true,
            'user_type' => 'Admin',
            'page_name' => 'Dashboard'
        ]);
    }
}
