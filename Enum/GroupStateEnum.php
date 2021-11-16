<?php

namespace Modules\GroupModule\Enum;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GroupStateEnum
{
    const PENDING = "Pending";
    const APPROVED = "Approved";
}
