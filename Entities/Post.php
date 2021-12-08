<?php

namespace Modules\GroupModule\Entities;

use App\Scopes\OrderingScope;
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
    protected static function booted()
    {
        static::addGlobalScope(new OrderingScope);
    }

}
