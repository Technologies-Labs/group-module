<?php

namespace Modules\GroupModule\Services;

use App\Models\User;
use App\Traits\ImageHelperTrait;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupImagesEnum;
use Modules\UserModule\Enum\UserEnum;

class UserGroupService
{
    use WithFileUploads , ImageHelperTrait;

    public $user;
    public $name;
    public $groupName;
    public $description;
    public $image;
    public $is_public;
    public $coverImage;

    private $path = '';

    public function createUserGroup()
    {
        return Group::create(
            [
                'name'                  => preg_replace('/\s+/', '', ucwords($this->name)),
                'group_name'            => $this->name,
                'user_id'               => $this->user->id,
                'group_description'     => $this->description,
                'group_image'           => $this->image,
                'group_cover_image'     => $this->coverImage,
            ]
        );

        // $userGroup->supervisors()->attach($this->user->id , ['is_owner' => 1]);

        // return response()->json([
        //     'success'       => ($userGroup) ? true : false,
        //     'message'       => ($userGroup) ? 'User Group created successfully' : 'User Group Failed created',
        // ]);
    }

    public function updateGroup(Group $group)
    {
        $group->update([
            'group_name'            => $this->name,
            'group_description'     => $this->description,
            'group_image'           => ($this->image ?? $group->group_image),
            'is_public'             => $this->is_public
        ]);

        return response()->json([
            'success'       => ($group) ? true : false,
            'message'       => ($group) ? 'Group updated successfully' : 'Group Failed updated',
        ]);
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setImage($image)
    {
        //$image->store('groups/', 'public');

        if ($image) {
            $this->image = $this->uploadImageWithIntervention($image , 115 ,115,GroupImagesEnum::IMAGE)['name'];
        } else {
            $this->image = UserEnum::USER_GROUP_DEFAULT_IMAGE;
        }

        return $this;
    }

    public function setCoverImage($image)
    {
        //$image->store('groups/' . $this->user->name, 'public');
        if ($image) {
            $this->coverImage =$this->uploadImageWithIntervention($image,1202,425,GroupImagesEnum::COVER_IMAGE)['name'] ;
        } else {
            $this->coverImage = UserEnum::USER_GROUP_DEFAULT_IMAGE;
        }

        return $this;
    }

    public function updateImage($image, $old)
    {
        if ($image) {
            $this->image = $image->store('groups/' . $this->user->name, 'public');
            if ($old != UserEnum::USER_GROUP_DEFAULT_IMAGE) {
                File::delete('assets/images/user_groups' . $old);
            }
        }
        return $this;
    }

    public function setIsPublic($isPublic)
    {
        $this->is_public = $isPublic;
        return $this;
    }
}
