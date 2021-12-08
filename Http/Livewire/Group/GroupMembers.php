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

    public $readyToLoad = false;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['loadApprovedMembers' , 'loadPendingMembers'];


    public function getMembersProperty()
    {
        return ($this->readyToLoad) ? $this->groupRepository->getGroupMembers($this->group , $this->state , 20)->getData() : [];
    }

    public function boot()
    {
        $this->groupRepository  = new UserGroupRepository();
    }

    public function loadApprovedMembers()
    {
        $this->readyToLoad = true ;
    }

    public function loadPendingMembers()
    {
        $this->readyToLoad = true ;
    }

    public function render()
    {
        return view('groupmodule::livewire.group.group-members',[
            'users' => $this->members
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
