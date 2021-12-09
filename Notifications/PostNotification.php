<?php

namespace Modules\GroupModule\Notifications;

use App\Actions\Notification\SendBellNotificationAction;
use App\Models\User;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Entities\Post;
use Modules\GroupModule\Jobs\PostBellNotificationJob;
use Modules\NotificationModule\Entities\Notification;
use Modules\NotificationModule\Enums\NotificationTypeEnum;
use Modules\NotificationModule\Notifications\NotificationAbstract;

class PostNotification extends NotificationAbstract
{
    private $message;

    public Post $post;
    public Group $group;
    public User $user;

    public function setPost(Post $post)
    {
        $this->post = $post;
        return $this;
    }

    public function setGroup(Group $group)
    {
        $this->group = $group;
        return $this;
    }

    public function setUser(User $user)
    {
        $this->user = $user;
        return $this;
    }

    public function setCreatePostMessage()
    {
        $search             = array('user_full_name' , 'group_name' , 'post_title');
        $replace            = array($this->user->full_name , $this->group->group_name , $this->post->title);
        $this->message      = str_replace($search, $replace, $this->template->content);

        return $this;
    }

    public function handle()
    {
        $action     = new PostBellNotificationJob();
        $action->onQueue('bell-notification')->execute($this->group , $this->message);
    }
}
