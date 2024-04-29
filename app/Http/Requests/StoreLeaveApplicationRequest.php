<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use App\Rules\CrossDateCheck;
use App\Rules\CheckLeave;
use App\Enums\LeaveType;

class StoreLeaveApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            "start_date" => "required|date",
            "end_date"   => ["required", "date", new CrossDateCheck, new CheckLeave],
            "leave_type" => "required",
            "reason"       => "nullable|string"
        ];
    }
}
