<?php

namespace Modules\Group\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class GroupScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
        $builder->orderBy('id','DESC');
    }
}
