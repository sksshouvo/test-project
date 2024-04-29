<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeaveApplicationRequest;
use App\Http\Requests\UpdateLeaveApplicationRequest;
use App\Interface\LeaveApplication\LeaveApplicationService;
use Log;
use DB;

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
            return to_route('dashboard');
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
