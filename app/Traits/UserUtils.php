<?php
namespace App\Traits;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

trait UserUtils {
    public function userType() {
        return Auth::guard('admin')->user() ? 'admin' : 'employee';
    }
}