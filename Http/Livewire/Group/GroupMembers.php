<?php

namespace Modules\Group\Http\Livewire\Group;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Group\Entities\Group;
use Modules\Group\Entities\GroupMember;
use Modules\Group\Enum\GroupStateEnum;
use Modules\Group\Notifications\MemberNotification;
use Modules\Group\Repositories\UserGroupRepository;
use Modules\Group\States\GroupMember\GroupMemberApproved;
use Modules\Notification\Enums\NotificationTemplateKeysEnums;

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
        return view('group::livewire.group.group-members',[
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

        $memberNotification = new MemberNotification();
        $memberNotification
        ->setTemplate(NotificationTemplateKeysEnums::APPROVED_MEMBER)
        ->setMember($member->user_id)
        ->setGroup($this->group)
        ->handle();

        $this->emit('showMessage', ['icon' => 'success', 'text' => "Your User Added Successfully To Group ", 'title' => 'Add Member']);
    }

    public function deleteMember($id)
    {
        $member = GroupMember::find($id);
        if (!$member) {
            abort(404);
        }
        $member->delete();
        $memberNotification = new MemberNotification();
        $memberNotification
        ->setTemplate(NotificationTemplateKeysEnums::DELETE_MEMBER)
        ->setMember($member->user_id)
        ->setGroup($this->group)
        ->handle();
        $this->emit('showMessage', ['icon' => 'success', 'text' => "Your User Cancel Successfully From Group ", 'title' => 'Cancel Member']);
    }
}
