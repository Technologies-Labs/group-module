<?php

namespace Modules\GroupModule\Transformers;

use App\Models\User;
use Modules\GroupModule\Entities\Group;
use Modules\GroupModule\Enum\GroupStateEnum;
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
