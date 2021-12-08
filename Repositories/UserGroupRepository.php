<?php


namespace Modules\GroupModule\Repositories;


use App\Models\User;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;
use Modules\GroupModule\Transformers\GroupMembersTransformer;
use Modules\GroupModule\Transformers\GroupPostsTransformer;
use Modules\GroupModule\Transformers\GroupTransformer;
use Modules\GroupModule\Transformers\UserGroupsTransformer;


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
