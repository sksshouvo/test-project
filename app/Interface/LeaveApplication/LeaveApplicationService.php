<?php

namespace App\Interface\LeaveApplication;
use App\Models\LeaveApplication;

class LeaveApplicationService implements LeaveApplicationInterface {
    
    public function __construct(private readonly LeaveApplication $leaveApplication) {
        
    }

    public function create ($request): mixed {

        $leaveApplication = new LeaveApplication;
        $leaveApplication->start_date = $request['start_date'];
        $leaveApplication->end_date = $request['end_date'];
        $leaveApplication->leave_type = $request['leave_type'];
        $leaveApplication->note = $request['note'] ?? NULL;
        $leaveApplication->save();
        return $leaveApplication;
    }

    public function update ($request, int $id): mixed {

        $leaveApplication = $this->leaveApplication->findOrfail($id);
        $leaveApplication->start_date = $request->start_date;
        $leaveApplication->end_date = $request->end_date;
        $leaveApplication->leave_type = $request->leave_type;
        $leaveApplication->note = $request->note ?? NULL;
        $leaveApplication->save();
        return $leaveApplication;

    }

    public function getAll() : mixed {
        return $this->leaveApplication->paginate(config('app.paginate_size'));
    }

    public function getSingle(int $id): mixed {
        return $this->leaveApplication->findOrfail($id);
    }
    
    public function delete(int $id): mixed {
        $leaveAplication =  $this->leaveApplication->findOrfail($id);
        if ($leaveAplication) {
            $leaveAplication->delete();
            return $leaveAplication;
        }

        return false;
    }

}