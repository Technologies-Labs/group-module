<?php

namespace Modules\GroupModule\Http\Livewire\Group;

use App\Traits\ModalHelper;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Entities\Post;
use Modules\GroupModule\Repositories\UserGroupRepository;
use Modules\GroupModule\Services\UserGroupService;

class GroupPosts extends Component
{
    use WithFileUploads, WithPagination, ModalHelper;
    private $groupRepository;
    private $groupService;

    public $isOwner;
    public Group $group;

    public Post $post;
    public $user;

    public $title;
    public $content;
    public $image;

    public $modal;
    public $updateModel = false;

    public function getPostsProperty()
    {
        $posts =  $this->groupRepository->getGroupPosts($this->group);
        return $posts['posts'];
    }

    protected $paginationTheme = 'bootstrap';

    protected $rules = [
        'title' => 'required',
        'content' => 'required',
        'image' => 'required| image',
    ];
    protected $listeners = [
        'postsRefresh' => '$refresh',
    ];

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

    public function booted()
    {

        $this->user     = $this->group->user;
    }

    public function __construct()
    {
        $this->setPostCreateModal();
        $this->groupRepository      = new UserGroupRepository();
        $this->groupService         = new UserGroupService();
    }


    public function render()
    {
        return view('groupmodule::livewire.group.group-posts', [
            'posts' => $this->posts,
        ]);
    }

    public function createPost()
    {
        $this->validate($this->rules);
        $data = [
            'title'     => $this->title,
            'content'   => $this->content,
            'image'     => $this->image->store('groups/posts', 'public'),
            'group_id'   => $this->group->id,
        ];
        $post = Post::create($data);
        $this->emit('postsRefresh');
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
    }

    public function updatePost()
    {
        $this->validate($this->rules);
        $post           = $this->post;
        $post->title    = $this->title;
        $post->content  = $this->content;
        $post->image    = $this->image ? $this->image->store('groups/posts', 'public') : $post->image;
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
        $this->emit('deleteItem',"#group-post-".$post->id);
        // $this->setPostCreateModal();
        $this->modalClose('.add-post-popup', 'success', "Your Post Deleted Successfully", "Post Deleted");
    }
}
