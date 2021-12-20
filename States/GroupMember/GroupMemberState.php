<?php

namespace Modules\Group\States\GroupMember;

use Spatie\ModelStates\State;
use Spatie\ModelStates\StateConfig;

abstract class GroupMemberState extends State
{
    abstract public function name();

    public static function config(): StateConfig
    {
        return parent::config()
            ->default(GroupMemberPending::class)
            ->allowTransition(GroupMemberPending::class, GroupMemberApproved::class)
        ;
    }
}
