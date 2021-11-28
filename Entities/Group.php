<?php

namespace Modules\GroupModule\Entities;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\GroupModule\Enum\GroupStateEnum;

class Group extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function getRouteKeyName()
    {
        return 'name';
    }

    // public function supervisors()
    // {
    //     return $this->belongsToMany(User::class , 'group_supervisors');
    // }

    // public function owner()
    // {
    //     return $this->belongsToMany(User::class , 'group_supervisors')->wherePivot('is_owner' , 1);
    // }

    // public function invitations() {
    //     return $this->belongsToMany(User::class , 'group_members')->wherePivot('invite_status' , 0);
    // }

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id','id');
    }

    public function members() {
        return $this->belongsToMany(User::class , 'group_members')->withPivot('id','state');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
