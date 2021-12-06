<?php


namespace Modules\GroupModule\Repositories;


use App\Models\User;
use League\Fractal\Resource\Collection;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;
use Modules\GroupModule\Transformers\GroupTransformer;
use Modules\GroupModule\Transformers\UserGroupsTransformer;


class UserGroupRepository
{
    public function getUserGroups(User $user)
    {
       $groups = $user->ownerGroups->each(function ($item){
            $item->setAttribute('is_owner', true);
        })->merge($user->groups);
        return new Collection($groups, new UserGroupsTransformer);

        //return (new GroupTransformer())->userGroupsTransformer($user);
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
