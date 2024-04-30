<?php

namespace App\Interface\LeaveApplication;
use App\Events\UpdateLeaveApplicationStatus;
use App\Models\LeaveApplication;
use App\Traits\UserUtils;

class LeaveApplicationService implements LeaveApplicationInterface {

    use UserUtils;

    public function __construct(private readonly LeaveApplication $leaveApplication) {
        
    }

    public function create ($request): mixed {

        $leaveApplication = new LeaveApplication;
        $leaveApplication->start_date = $request['start_date'];
        $leaveApplication->end_date = $request['end_date'];
        $leaveApplication->leave_type = $request['leave_type'];
        $leaveApplication->reason = $request['reason'] ?? NULL;
        $leaveApplication->creator_type = $this->userType();
        $leaveApplication->save();
        return $leaveApplication;
    }

    public function update ($request, int $id): mixed {

        $leaveApplication = $this->leaveApplication->findOrfail($id);
        $leaveApplication->start_date = $request->start_date;
        $leaveApplication->end_date = $request->end_date;
        $leaveApplication->leave_type = $request->leave_type;
        $leaveApplication->reason = $request->reason ?? NULL;
        $leaveApplication->updator_type = $this->userType();
        $leaveApplication->save();
        return $leaveApplication;

    }

    public function getAll() : mixed {
        return $this->leaveApplication::with(['creator'])->userTypeWisesFilter()->get();
    }

    public function getSingle(int $id): mixed {
        return $this->leaveApplication::with(['creator'])->findOrfail($id);
    }
    
    public function delete(int $id): mixed {
        $leaveAplication =  $this->leaveApplication->findOrfail($id);
        if ($leaveAplication) {
            $leaveAplication->delete();
            return $leaveAplication;
        }

        return false;
    }

    public function statusWiseLeaveApplications($status): mixed {
        return $this->leaveApplication::with(['creator'])->userTypeWisesFilter()->statusWiseFilter($status)->get();
    }

    public function updateStatus(int $id, string $status, string|null $comment): mixed {
        
        $leaveApplication = $this->leaveApplication->statusWiseFilter("pending")->find($id);
        if ($leaveApplication) {
            $leaveApplication->status = $status ?? "pending";
            $leaveApplication->comment = $comment ?? NULL;
            $leaveApplication->updator_type = $this->userType();
            $leaveApplication->save();
            UpdateLeaveApplicationStatus::dispatch($leaveApplication);
            return $leaveApplication;
        }

        return false;
    }

}