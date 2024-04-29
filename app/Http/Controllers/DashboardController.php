<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Interface\LeaveApplication\LeaveApplicationService;

class DashboardController extends Controller
{
    public function __construct(public readonly LeaveApplicationService $leaveApplicationService) {
        
    }

    public function index(Request $request) {
        return Inertia::render('Dashboard', [
            'logged_in' => true,
            'user_type' => 'Employee',
            'page_name' => 'Dashboard',
            'leave_applications' => $this->leaveApplicationService->getAll()
        ]);
    }
}
