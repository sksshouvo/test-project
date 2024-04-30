<?php

namespace App\Http\Controllers\Admin;

use App\Interface\LeaveApplication\LeaveApplicationService;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
class DashboardController extends Controller
{
    private $auth;
    
    public function __construct(public LeaveApplicationService $leaveApplicationService) {
        $this->auth = Auth::guard('admin')->user();
    }

    public function index(Request $request) {

        $allLeaveApps = $this->leaveApplicationService->getAll();
        $totalPendingLeaves = $this->leaveApplicationService->statusWiseLeaveApplications(status: "pending");
        $totalApprovedLeaves = $this->leaveApplicationService->statusWiseLeaveApplications(status: "approved");

        return Inertia::render("Admin/Dashboard", [
            'admin' => $this->auth,
            'logged_in' => true,
            'user_type' => 'Admin',
            'page_name' => 'Dashboard',
            'total_leaves' => $allLeaveApps->count(),
            'total_pending_leaves' => $totalPendingLeaves->count(),
            'total_approved_leaves' => $totalApprovedLeaves->count()
        ]);
    }
}
