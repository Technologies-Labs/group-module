<?php

namespace Modules\GroupModule\Http\Controllers;

use App\Models\User;
use Auth;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Livewire\WithPagination;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Entities\GroupMember;
use Modules\GroupModule\Enum\GroupStateEnum;
use Modules\GroupModule\Repositories\UserGroupRepository;
use Modules\GroupModule\Services\GroupMembersService;
use Modules\GroupModule\States\GroupMember\GroupMemberApproved;
use Modules\GroupModule\States\GroupMember\GroupMemberPending;

class GroupController extends Controller
{
    use WithPagination;
    private $groupRepository;

    public function __construct()
    {
        $this->groupRepository  = new UserGroupRepository();
    }
    public function getGroupDetails(Group $group)
    {
        $user    = Auth::user();
        $isOwner = $user->id == $group->user_id;
        //$posts   = $this->groupRepository->getGroupPosts($group);
        $members = $group->members;
        $member = $members->where('name', $user->name)->first();

        if( !$isOwner && !$member){
            $member = (new GroupMembersService())
                ->setUser($user)
                ->setGroup($group)
                ->setState(GroupMemberPending::class)
                ->addMember();
            return redirect()->back()->with('success', "Successfully Invaite");
        }


        if(!$isOwner && $member->pivot->state == GroupStateEnum::PENDING){
            return redirect()->back()->with('success', "Pending");
        }
        return view('groupmodule::website.group', compact('group', 'isOwner', 'members'));
    }

    public function addMember(Request $request, Group $group)
    {
        foreach ($request->users as $user) {
            $user = User::whereName($user)->first();
            if (!$user) {
                continue;
            }

            $member = (new GroupMembersService())
                ->setUser($user)
                ->setGroup($group)
                ->setState(GroupMemberApproved::class)
                ->addMember()
                ->getData();
        }

        return redirect()->back()->with('success', "The user has been successfully added to the group");
    }
}
