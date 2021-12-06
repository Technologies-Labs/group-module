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

    //public $groups;

    public $name;
    public $description;
    public $image;
    public $coverImage;
    public $readyToLoad = false;

    protected $listeners = ['loadGroups'];

    public function getGroupsProperty()
    {
        return ($this->readyToLoad) ? $this->userGroupRepository->getUserGroups($this->user)->getData() : [];
    }

    public function loadGroups()
    {
        $this->readyToLoad = true ;
    }

    public function __construct()
    {

        $this->userGroupService     = new UserGroupService;
        $this->userGroupRepository  = new UserGroupRepository;
    }

    // public function mount()
    // {
    //     $this->groups  = ($this->readyToLoad) ? $this->userGroupRepository->getUserGroups($this->user)->getData() : [];
    // }

    public function render()
    {

        return view('groupmodule::livewire.group.user-groups',[
            'groups' => $this->groups
        ]);
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
        $this->validate($this->rules());
        $group = $this->userGroupService
        ->setUser($this->user)
        ->setName($this->name)
        ->setDescription($this->description)
        ->setImage($this->image)
        ->setCoverImage($this->coverImage)
        ->createUserGroup();
        $this->groups = $this->groups->push($group);
        $this->emit('modalClose', '.add-group-popup');
        $this->emit('showMessage', ['icon' => 'success', 'text' => "Your Group Created Successfully", 'title' => 'Group Create']);

    }
}
