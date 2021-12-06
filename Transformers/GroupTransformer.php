<?php

namespace Modules\GroupModule\Transformers;

use App\Models\User;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;

class GroupTransformer
{
    // public function userGroupsTransformer(User $user)
    // {
    //     return $user->ownerGroups->each(function ($item){
    //         $item->setAttribute('is_owner', true);
    //     })->merge($user->groups);
    //     // dd($user->groups()->with('members')->get());
    //     //dd($user->ownerGroups->merge($user->groups));
    //     // return [
    //     //     'groups'        => $groups,
    //     // ];
    // }

    public function groupMembersTransformer(Group $group , $state)
    {
        return [
            'members'        => $group->members()->wherePivot('state' , $state)->paginate(10),
        ];
    }

    public function groupPostsTransformer(Group $group)
    {
        //->orderBy('id','DESC')
        return [
            'posts'        =>  $group->posts()->orderBy('id','DESC')->paginate(2),
        ];
    }


}
