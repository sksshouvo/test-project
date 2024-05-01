<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Interface\User\UserService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    public function __construct (public UserService $userService) {
        $this->auth = Auth::guard('admin')->user();
    }

    public function index() {

        return Inertia::render("Admin/Users", [
            'admin' => $this->auth,
            'logged_in' => true,
            'user_type' => 'Admin',
            'page_name' => 'Users',
            'users' => $this->userService->getAll()
        ]);
    }
}
