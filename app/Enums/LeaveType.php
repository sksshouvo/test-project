<?php

namespace App\Enums;
use App\Traits\EnumToArray;

enum LeaveType: string
{
    use EnumToArray;
    
    case CASUAL    = "casual";
    case SICK      = "sick";
    case EMERGENCY = "emergency";
}
