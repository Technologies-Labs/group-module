<?php

namespace Modules\GroupModule\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

}
