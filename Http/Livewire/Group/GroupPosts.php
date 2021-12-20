<?php

namespace Modules\Group\Http\Livewire\Group;

use App\Actions\Notification\SendNotification;
use App\Traits\ImageHelperTrait;
use App\Traits\ModalHelper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\Group\Entities\Group;
use Modules\Group\Entities\Post;
use Modules\Group\Enum\GroupImagesEnum;
use Modules\Group\Enum\GroupStateEnum;
use Modules\Group\Repositories\UserGroupRepository;
use Modules\Group\Services\UserGroupService;
use Modules\Notification\Enums\NotificationTemplateKeysEnums;
use Modules\Group\Notifications\PostNotification;

class GroupPosts extends Component
{

    use WithFileUploads, ModalHelper , ImageHelperTrait;

    private $groupRepository;

    public $isOwner;
    public Group $group;

    public Post $post;
    public $user;

    public $title;
    public $content;
    public $image;

    public $modal;
    public $updateModel = false;

    public  $perPage = 10;
    public  $page;

    public function loadMore()
    {
        $this->perPage += 10;
    }

    public function getPostsProperty()
    {
        return $this->groupRepository
        ->getGroupPosts($this->group , $this->perPage , $this->page)
        ->getData();
    }

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required| image',
    ];

    public function boot()
    {
        $this->setPostCreateModal();
        $this->groupRepository      = new UserGroupRepository();
    }

    public function booted()
    {
        $this->user     = $this->group->user;
    }

    public function setPostCreateModal()
    {
        $this->modal = [
            'name'  => 'Create',
            'title' => 'Create Post',
            'route' => 'createPost()'
        ];
    }

    public function setPostUpdateModal()
    {
        $this->modal = [
            'name'  => 'Update',
            'title' => 'Edit Post',
            'route' => 'updatePost()'
        ];
    }

    public function render()
    {
        return view('group::livewire.group.group-posts', [
            'posts' =>  $this->posts ,
        ]);
    }

    public function createPost()
    {

        $this->validate($this->rules);
        $data = [
            'title'     => $this->title,
            'content'   => $this->content,
            'image'     => $this->uploadImageWithIntervention($this->image ,  549, 329, GroupImagesEnum::POSTS_IMAGE_PATH)['name'],
            'group_id'   => $this->group->id,
        ];

        $post = Post::create($data);

        $postNotification = new PostNotification();
        $postNotification
        ->setTemplate(NotificationTemplateKeysEnums::CREATE_POST)
        ->setUser($this->user)
        ->setPost($post)
        ->setGroup($this->group)
        ->setCreatePostMessage()
        ->handle();

        //$this->emit('postsRefresh');
        $this->modalClose('.add-post-popup', 'success', 'Your Post Created Successfully', 'Post Create');
    }

    public function editPost($id)
    {
        $post               = $this->posts->find($id);
        $this->post         = $post;

        $this->title        = $post->title;
        $this->content      = $post->content;
        // $this->image        = $post->image;
        $this->setPostUpdateModal();
        $this->emit('showPopup','.add-post-popup');
    }

    public function updatePost()
    {
        $this->validate($this->rules);
        $post           = $this->post;
        $post->title    = $this->title;
        $post->content  = $this->content;
        $post->image    = $this->image ? $this->uploadImageWithIntervention($this->image ,  549, 329, GroupImagesEnum::POSTS_IMAGE_PATH)['name'] : $post->image;
        $post->save();

        $this->modalClose('.add-post-popup', 'success', 'Your Post Updated Successfully', 'Post Updated');
    }

    public function deletePost($id)
    {
        $post = $this->posts->find($id);
        if (!$post ||  !$post->delete()) {
            $this->modalClose('.add-post-popup', 'error', "Post Deleted", "Post Deleted");
            return null;
        }
        // $this->posts = $this->posts = $this->posts->filter(function ($item) use ($post) {
        //     return $item->id != $post->id;
        // });
        $this->emit('deleteItem', "#group-post-" . $post->id);
        // $this->setPostCreateModal();
        $this->modalClose('.add-post-popup', 'success', "Your Post Deleted Successfully", "Post Deleted");
    }
}
