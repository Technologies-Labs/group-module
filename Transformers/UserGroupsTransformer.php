<?php

namespace Modules\GroupModule\Transformers;

use App\Models\User;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;
use League\Fractal\TransformerAbstract;

class UserGroupsTransformer extends TransformerAbstract
{

    public function transform(Group $group)
	{
	    return [
	        'id'                    => (int) $group->id,
	        'name'                  => $group->name,
	        'group_name'            => $group->group_name,
            "group_description"     => $group->group_description,
            'group_image'           => $group->group_image,
            'group_cover_image'     => $group->group_cover_image,
            'user_id'               => $group->user_id,

	    ];
	}
}
