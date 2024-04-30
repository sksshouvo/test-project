<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;
use Auth;

class LeaveApplication extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = ["start_date", "end_date", "leave_type", "reason", "comment"];

    public function scopedateRangeWiseFilter(Builder $query, $startDate, $endDate) : void {
        $query->where('start_date', $startDate)->where('end_date', $endDate);
    }

    public function scopeWithoutStatusWiseFilter(Builder $query, $status) : void {
        $query->where('status', '!=' ,$status);
    }

    public function scopeUserTypeWisesFilter(Builder $query) : void {
        if (!Auth::guard('admin')->user()) {
            $query->where("created_by", Auth::id());
        }
    }

    public function scopeUserWiseFilter(Builder $query) : void {
        $query->where('created_by', Auth::id());
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    

    /**
     * Get the user's first name.
     */
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date("d-m-Y h:i:s", strtotime($value)),
        );
    }

    /**
     * Get the user's first name.
     */
    protected function startDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date("d-m-Y", strtotime($value)),
        );
    }

    /**
     * Get the user's first name.
     */
    protected function endDate(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => date("d-m-Y", strtotime($value)),
        );
    }

    public function scopeStatusWiseFilter($query, $status): void {
        $query->where('status' ,$status);
    }
}
