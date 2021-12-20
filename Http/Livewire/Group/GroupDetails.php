<?php

namespace Modules\Group\Http\Livewire\Group;

use App\Models\User;
use Livewire\Component;
use Modules\Group\Entities\Group;
use Modules\Group\Enum\GroupImagesEnum;
use Modules\Group\Repositories\UserGroupRepository;

class GroupDetails extends Component
{
    public $group;
    public $isOwner;
    public $users;
    public $members;


    public function mount()
    {
        $this->members = $this->group->members;
        $this->users = User::all()->diff($this->members);
    }
    public function render()
    {

        return view('group::livewire.group.group-details');
    }
}
