<?php

namespace Modules\GroupModule\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\GroupModule\Entities\Post;

class GroupPostsTransformer extends TransformerAbstract
{

    public function transform(Post $post)
	{
	    return [
	        'id'        => (int) $post->id,
	        'title'     => $post->title,
	        'content'   => $post->content,
            "image"     => $post->image,
            'group_id'  => $post->group_id,
	    ];
	}
}
