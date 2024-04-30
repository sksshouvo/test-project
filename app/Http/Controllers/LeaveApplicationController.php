<?php

namespace App\Http\Controllers;

use App\Interface\LeaveApplication\LeaveApplicationService;
use App\Http\Requests\AdminUpdateLeaveApplicationRequest;
use App\Http\Requests\StoreLeaveApplicationRequest;
use App\Http\Requests\UpdateLeaveApplicationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class LeaveApplicationController extends Controller
{
    public function __construct(public LeaveApplicationService $leaveApplicationService) {
        
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLeaveApplicationRequest $request)
    {
        try {
            DB::beginTransaction();
            $leaveApplication = $this->leaveApplicationService->create($request->all());
            DB::commit();
            return Inertia::render('Dashboard', [
                'logged_in' => true,
                'user_type' => 'Employee',
                'page_name' => 'Dashboard',
                'leave_applications' => $this->leaveApplicationService->getAll(),
                'form_submit' => true
            ]);
        } catch (\Exception $e) {
            
            DB::rollback();
            Log::emergency($e);
            return false;
        };
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return $this->leaveApplicationService->getSingle($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LeaveApplication $leaveApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLeaveApplicationRequest $request, LeaveApplication $leaveApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leaveDelete =  $this->leaveApplicationService->delete($id);

        if ($leaveDelete) {
            return Inertia::render('Dashboard', [
                'logged_in' => true,
                'user_type' => 'Employee',
                'page_name' => 'Dashboard',
                'leave_applications' => $this->leaveApplicationService->getAll(),
                'form_submit' => true
            ]);
        }
    }

    public function listForAdmin() {
        return Inertia::render('Admin/Leaves', [
            'admin' => Auth::guard('admin')->user(),
            'logged_in' => true,
            'user_type' => 'Admin',
            'page_name' => 'Leave Application List',
            'leave_applications' => $this->leaveApplicationService->getAll(),
        ]);
    }

    public function updateStatus(AdminUpdateLeaveApplicationRequest $request, $id) {
        $leaveUpdate = $this->leaveApplicationService->updateStatus($id, $request->status, $request->comment);
        
        return Inertia::render('Admin/Leaves', [
            'admin' => Auth::guard('admin')->user(),
            'logged_in' => true,
            'user_type' => 'Admin',
            'page_name' => 'Leave Application List',
            'leave_applications' => $this->leaveApplicationService->getAll(),
        ]);
    }
}
