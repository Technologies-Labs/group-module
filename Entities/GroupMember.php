<?php

namespace Modules\GroupModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GroupModule\States\GroupMember\GroupMemberState;
use Spatie\ModelStates\HasStates;

class GroupMember extends Model
{
    use HasFactory , HasStates;

    protected $fillable = ['group_id' , 'user_id' , 'state'];

    protected $casts = [
        'state' => GroupMemberState::class,
    ];


}
