<?php

namespace Modules\GroupModule\Http\Livewire\Group;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Entities\GroupMember;
use Modules\GroupModule\Enum\GroupStateEnum;
use Modules\GroupModule\Repositories\UserGroupRepository;
use Modules\GroupModule\States\GroupMember\GroupMemberApproved;

class GroupMembers extends Component
{
    use WithPagination;
    private $groupRepository;

    public $membersRepository;
    public $group;
    public $state;

    protected $paginationTheme = 'bootstrap';

    public function __construct()
    {
        $this->groupRepository  = new UserGroupRepository();
    }

    public function render()
    {

        $this->membersRepository = $this->groupRepository->getGroupMembers($this->group , $this->state);
        //dd($this->membersRepository['members']);
        return view('groupmodule::livewire.group.group-members',[
            'users' => $this->membersRepository['members']
        ]);
    }

    public function approvedMember($id)
    {
        $member = GroupMember::find($id);
        if (!$member) {
            abort(404);
        }
        $member->state->transitionTo(GroupMemberApproved::class);
        $this->emit('showMessage', ['icon' => 'success', 'text' => "Your User Added Successfully To Group ", 'title' => 'Add Member']);
    }

    public function deleteMember($id)
    {
        $member = GroupMember::find($id);
        if (!$member) {
            abort(404);
        }
        $member->delete();
        $this->emit('showMessage', ['icon' => 'success', 'text' => "Your User Cancel Successfully From Group ", 'title' => 'Cancel Member']);
    }
}
