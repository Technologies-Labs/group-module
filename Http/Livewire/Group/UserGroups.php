<?php

namespace Modules\Group\Http\Livewire\Group;

use App\Traits\ModalHelper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Group\Repositories\UserGroupRepository;
use Modules\Group\Services\UserGroupService;

class UserGroups extends Component
{
    use WithFileUploads , ModalHelper;

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

        return view('group::livewire.group.user-groups',[
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
        $this->modalClose('.add-group-popup' , 'success' ,'Your Group Created Successfully' ,'Group Create');
    }
}
