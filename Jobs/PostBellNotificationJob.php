<?php

namespace Modules\GroupModule\Jobs;

use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;
use Modules\GroupModule\Repositories\UserGroupRepository;
use Modules\GroupModule\States\GroupMember\GroupMemberState;
use Modules\NotificationModule\Entities\Notification;
use Modules\NotificationModule\Enums\NotificationTypeEnum;
use Modules\NotificationModule\Traits\NotificationTrait;
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
