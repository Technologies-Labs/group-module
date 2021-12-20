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
