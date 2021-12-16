<?php

namespace Modules\GroupModule\Entities;

use App\Scopes\OrderingScope;
use Database\Factories\GroupMembersFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\GroupModule\States\GroupMember\GroupMemberState;
use Spatie\ModelStates\HasStates;

class GroupMember extends Model
{
    use HasFactory , HasStates ,  HasFactory;

    protected $fillable = ['group_id' , 'user_id' , 'state'];

    protected $casts = [
        'state' => GroupMemberState::class,
    ];

    protected static function booted()
    {
        static::addGlobalScope(new OrderingScope);
    }
    protected static function newFactory()
    {
        return GroupMembersFactory::new();
    }



}
