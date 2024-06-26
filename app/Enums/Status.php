<?php

namespace App\Enums;
use App\Traits\EnumToArray;

enum Status: string
{
    use EnumToArray;

    case PENDING     = 'pending';
    case IN_PROGRESS = 'in_progress';
    case APPROVED    = 'approved';
    case FAILED      = 'failed';
    case REJECTED    = 'rejected';
    case NEED_DISCUSSION = "need-discussion";
}
