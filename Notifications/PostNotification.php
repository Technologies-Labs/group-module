<?php

namespace Modules\Group\Notifications;

use App\Actions\Notification\SendBellNotificationAction;
use App\Models\User;
use Modules\Group\Entities\Group;
use Modules\Group\Entities\Post;
use Modules\Group\Jobs\PostBellNotificationJob;
use Modules\Notification\Entities\Notification;
use Modules\Notification\Enums\NotificationTypeEnum;
use Modules\Notification\Notifications\NotificationAbstract;

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
