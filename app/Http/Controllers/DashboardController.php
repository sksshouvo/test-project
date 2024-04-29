<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request) {
        return Inertia::render('Dashboard', [
            'logged_in' => true,
            'user_type' => 'Employee',
            'page_name' => 'Dashboard'
        ]);
    }
}
