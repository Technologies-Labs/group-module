<?php

namespace Modules\GroupModule\Services;

use App\Models\User;
use Modules\GroupModule\Entities\GroupMember;

class GroupMembersService
{
    public $user;
    public $group;
    public $state;

    // public function inviteUser()
    // {
    //     $user = User::find($this->userId);
    //     $user->invitations()->attach($this->groupId);

    //     return response()->json([
    //         'success'       => ($user) ? true : false,
    //         'message'       => ($user) ? 'The user has been successfully invited to the group' : 'Failed to invite user to group',
    //     ]);
    // }

    public function addMember()
    {
        $user= GroupMember::create([
            'group_id'  => $this->group->id,
            'user_id'   => $this->user->id,
            'state'     => $this->state
        ]);

        return response()->json([
            'success'       => ($user) ? 'success' : 'fail',
            'message'       => ($user) ? 'The user has been successfully added to the group' : 'Failed to added user to group',
        ]);
    }

    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    public function setGroup($group)
    {
        $this->group = $group;
        return $this;
    }
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }
}
