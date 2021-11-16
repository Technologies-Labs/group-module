<?php

namespace Modules\GroupModule\States\GroupMember;


class GroupMemberPending extends GroupMemberState
{
    public static $name = "Pending";

    public function name()
    {
        return "Pending";
    }

}
