<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class LeaveApplication extends Model
{
    use HasFactory;

    protected $fillable = ["start_date", "end_date", "leave_type", "note"];

    public function scopedateRangeWiseFilter(Builder $query, $startDate, $endDate) : void {
        $query->where('start_date', $startDate)->where('end_date', $endDate);
    }

    public function scopeWithoutStatusWiseFilter(Builder $query, $status) : void {
        $query->where('status', '!=' ,$status);
    }
}
