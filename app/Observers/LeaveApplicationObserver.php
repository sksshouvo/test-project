<?php

namespace App\Observers;

use App\Models\LeaveApplication;

class LeaveApplicationObserver
{
    /**
     * Handle the LeaveApplication "created" event.
     */
    public function created(LeaveApplication $leaveApplication): void
    {
        //
    }

    /**
     * Handle the LeaveApplication "updated" event.
     */
    public function updated(LeaveApplication $leaveApplication): void
    {
        //
    }

    /**
     * Handle the LeaveApplication "deleted" event.
     */
    public function deleted(LeaveApplication $leaveApplication): void
    {
        //
    }

    /**
     * Handle the LeaveApplication "restored" event.
     */
    public function restored(LeaveApplication $leaveApplication): void
    {
        //
    }

    /**
     * Handle the LeaveApplication "force deleted" event.
     */
    public function forceDeleted(LeaveApplication $leaveApplication): void
    {
        //
    }
}
