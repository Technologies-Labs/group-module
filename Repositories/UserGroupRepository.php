<?php


namespace Modules\Group\Repositories;


use App\Models\User;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Modules\Group\Entities\Group;
use Modules\Group\Enum\GroupStateEnum;
use Modules\Group\Transformers\GroupMembersTransformer;
use Modules\Group\Transformers\GroupPostsTransformer;
use Modules\Group\Transformers\GroupTransformer;
use Modules\Group\Transformers\UserGroupsTransformer;


class UserGroupRepository
{
    public function getGroupInformation(Group $group)
    {
        return new Item($group, new UserGroupsTransformer);
    }

    public function getUserGroups(User $user)
    {
       $groups = $user->ownerGroups->each(function ($item){
            $item->setAttribute('is_owner', true);
        })->merge($user->groups);
        return new Collection($groups, new UserGroupsTransformer);
    }

    public function getGroupMembers(Group $group, $state , $paginate)
    {
        $members = $group->members()->wherePivot('state' , $state)->paginate($paginate, ['*'], null);
        return new Collection($members, new GroupMembersTransformer);
    }

    public function getGroupPosts(Group $group ,$paginate = 10 , $page)
    {
        $posts = $group->posts()->paginate($paginate, ['*'], null, $page);
        return new Collection($posts, new GroupPostsTransformer);
    }

}
