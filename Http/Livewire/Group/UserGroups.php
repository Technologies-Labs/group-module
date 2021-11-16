<?php

namespace Modules\GroupModule\Http\Livewire\Group;

use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\GroupModule\Repositories\UserGroupRepository;
use Modules\GroupModule\Services\UserGroupService;

class UserGroups extends Component
{
    use WithFileUploads;

    public $user;
    public $isCurrantUser;

    private $userGroupService;
    private $userGroupRepository;
    public $groups;

    public $name;
    public $description;
    public $image;
    public $coverImage;

    public function __construct()
    {
        $this->userGroupService     = new UserGroupService;
        $this->userGroupRepository  = new UserGroupRepository;
    }

    public function mount()
    {
        $userGroupRepository    = $this->userGroupRepository->getUserGroups($this->user);
        $this->groups           = $userGroupRepository['groups'];
    }
    public function render()
    {
        //dd($this->groups);
        //$this->groups = $this->userGroupRepository->getUserGroups($this->user);
        return view('groupmodule::livewire.group.user-groups');
    }

    public function rules()
    {
        return [
            'name'                  => 'required',
            'description'           => 'required',
            'image'                 => 'required | image',
            'coverImage'            => 'required | image',
        ];
    }



    public function createGroup()
    {

        $group = $this->userGroupService
        ->setUser($this->user)
        ->setName($this->name)
        ->setDescription($this->description)
        ->setImage($this->image)
        ->setCoverImage($this->coverImage)
        ->createUserGroup();
        $this->groups->push($group);
        $this->emit('modalClose', '.add-group-popup');
        $this->emit('showMessage', ['icon' => 'success', 'text' => "Your Group Created Successfully", 'title' => 'Group Create']);

    }
}
