<?php


namespace Modules\GroupModule\Repositories;


use App\Models\User;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;
use Modules\GroupModule\Transformers\GroupTransformer;

class UserGroupRepository
{
    public function getUserGroups(User $user)
    {
        return (new GroupTransformer())->userGroupsTransformer($user);
    }

    public function getGroupMembers(Group $group, $state)
    {
        return (new GroupTransformer())->groupMembersTransformer($group , $state);
    }

    public function getGroupPosts(Group $group)
    {
        return (new GroupTransformer())->groupPostsTransformer($group);
    }



    // public function getAllUserGroup($user_id)
    // {
    //     return User::where('id' , $user_id)->with(['supervisorGroups' , 'ownerGroups'])->get();
    // }
}
