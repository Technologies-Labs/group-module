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

class MemberNotification extends NotificationAbstract
{

    public $member;
    public Group $group;

    public function setGroup(Group $group)
    {
        $this->group = $group;
        return $this;
    }

    public function setMember($member)
    {
        $this->member = $member;
        return $this;
    }

    public function handle()
    {
        $search       = array('group_name');
        $replace      = array($this->group->group_name);
        $message      = str_replace($search, $replace, $this->template->content);

        $notification = new Notification();
        $notification->user_id = $this->member;
        $notification->type = NotificationTypeEnum::USER;
        $notification->message = $message;
        $notification->save();

    }
}
