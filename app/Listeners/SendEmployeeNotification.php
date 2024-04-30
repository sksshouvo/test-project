<?php

namespace App\Listeners;

use App\Notifications\LeaveApplicationStatusChanged;
use App\Events\UpdateLeaveApplicationStatus;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;

class SendEmployeeNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UpdateLeaveApplicationStatus $event): void
    {
        $leaveApp = $event->leaveApplication;
        $user = User::find($leaveApp->created_by);
        $user->notify(new LeaveApplicationStatusChanged($leaveApp));
    }
}
