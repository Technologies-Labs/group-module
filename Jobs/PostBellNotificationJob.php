<?php

namespace Modules\Group\Jobs;

use Modules\Group\Entities\Group;
use Modules\Group\Enum\GroupStateEnum;
use Modules\Group\Repositories\UserGroupRepository;
use Modules\Group\States\GroupMember\GroupMemberState;
use Modules\Notification\Entities\Notification;
use Modules\Notification\Enums\NotificationTypeEnum;
use Modules\Notification\Traits\NotificationTrait;
use Spatie\QueueableAction\QueueableAction;

class PostBellNotificationJob
{
    use QueueableAction , NotificationTrait;

    private $groupRepository;

    /**
     * Create a new action instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->groupRepository  = new UserGroupRepository();
    }

    /**
     * Execute the action.
     *
     * @return mixed
     */
    public function execute(Group $group , $message)
    {
        $members = $this->groupRepository->getGroupMembers($group , GroupStateEnum::APPROVED , null)->getData();
        foreach ($members as $user) {
            $this->createNotification($user , NotificationTypeEnum::USER , $message);
        }
    }
}
