<?php

namespace Modules\GroupModule\Http\Livewire\Group;

use App\Models\User;
use Livewire\Component;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupImagesEnum;
use Modules\GroupModule\Repositories\UserGroupRepository;

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

        return view('groupmodule::livewire.group.group-details');
    }
}
