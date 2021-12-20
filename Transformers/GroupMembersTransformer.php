<?php

namespace Modules\Group\Transformers;

use App\Models\User;
use Modules\Group\Entities\Group;
use Modules\Group\Enum\GroupStateEnum;
use League\Fractal\TransformerAbstract;

class GroupMembersTransformer extends TransformerAbstract
{

    public function transform(User $user)
	{
	    return [
	        'id'            => (int) $user->id,
	        'name'          => $user->name,
	        'image'         => $user->image,
	    ];
	}
}
