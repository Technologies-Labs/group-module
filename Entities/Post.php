<?php

namespace Modules\GroupModule\Entities;

use App\Scopes\OrderingScope;
use Database\Factories\PostsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes , HasFactory;

    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
    protected static function booted()
    {
        static::addGlobalScope(new OrderingScope);
    }

    protected static function newFactory()
    {
        return PostsFactory::new();
    }

}
