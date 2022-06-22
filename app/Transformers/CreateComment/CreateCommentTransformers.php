<?php

namespace App\Transformers\CreateComment;

use League\Fractal\TransformerAbstract;
use App\Models\Comment;

class CreateCommentTransformers extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user', 'product'
    ];

    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'parent_id' => $comment->parent_id,
            'slug' => $comment->slug,
            'content' => $comment->content,
            'published' => $comment->published,
            'published_at' => $comment->published_at,
            'created_at' => $comment->created_at,
            'updated_at' => $comment->updated_at,
            'children_comment' => []
        ];
    }

    public function includeProduct(Comment $comment)
    {
        $product = $comment->product;
        return $this->item($product, new ProductTransformers);
    }

    public function includeUser(Comment $comment)
    {
        $user = $comment->user;
        return $this->item($user, new UserTransformers);
    }
}
