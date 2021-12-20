<?php

namespace Modules\Group\Http\Livewire\Group;

use App\Traits\ModalHelper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Group\Entities\Group;
use Modules\Group\Repositories\UserGroupRepository;
use Modules\Group\Services\UserGroupService;

class GroupSetting extends Component
{
    use ModalHelper , WithFileUploads;
    private $userGroupRepository;

    public Group $group;

    public $name;
    public $description;
    public $image;
    public $coverImage;

    public function rules()
    {
        return [
            'name'                  => 'required',
            'description'           => 'required',
        ];
    }

    public function __construct()
    {
        $this->userGroupRepository  = new UserGroupRepository();
    }
    public function mount($group)
    {
        $this->group        = $this->userGroupRepository->getGroupInformation($group)->getData();
        $this->name         = $this->group->group_name;
        $this->description  = $this->group->group_description;
        $this->image        = $this->group->group_image;
        $this->coverImage   = $this->group->group_cover_image;

    }

    public function render()
    {
        return view('group::livewire.group.group-setting');
    }

    public function save()
    {
        $this->validate($this->rules());
        $groupService  = new UserGroupService();

        $groupService
        ->setName($this->name)
        ->setDescription($this->description)
        ->setImage($this->image)
        ->setCoverImage($this->coverImage)
        ->updateGroup($this->group);
        $this->modalClose('','success' , "Done","Done");
    }
}
