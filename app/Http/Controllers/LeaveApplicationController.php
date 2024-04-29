<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveApplicationRequest;
use App\Http\Requests\UpdateLeaveApplicationRequest;
use App\Interface\LeaveApplication\LeaveApplicationService;
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
    public function show(LeaveApplication $leaveApplication)
    {
        //
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
    public function destroy(LeaveApplication $leaveApplication)
    {
        //
    }
}
