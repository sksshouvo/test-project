<?php

namespace App\Interface\LeaveApplication;

interface LeaveApplicationInterface
{
    public function create($request): mixed;

    public function update($request, int $id): mixed;

    public function getAll(): mixed;

    public function getSingle(int $id): mixed;
    
    public function delete(int $id): mixed;

    public function statusWiseLeaveApplications(string $status): mixed;
    
    public function updateStatus(int $id, string $status, string $comment): mixed;
}
