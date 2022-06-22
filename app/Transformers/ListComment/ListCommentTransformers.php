<?php

namespace App\Transformers\ListComment;

use League\Fractal\TransformerAbstract;
use App\Models\Comment;

class ListCommentTransformers extends TransformerAbstract
{
    protected $defaultIncludes = [
        'user', 'product', 'children_comment'
    ];

    public function transform(Comment $comment)
    {
        return [
            'id' => $comment->id,
            'post_id' => $comment->post_id,
            'parent_id' => $comment->parent_id,
            'slug' => $comment->slug,
            'content' => $comment->content,
            'published' => $comment->published,
            'published_at' => $comment->published_at,
            'created_at' => $comment->created_at,
            'updated_at' => $comment->updated_at
        ];
    }

    public function includeChildrenComment(Comment $comment)
    {
        $childrenComment = $comment->childrenComment()->orderBy('created_at', 'desc')->get();
        return $this->collection($childrenComment,  new ListCommentTransformers);
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
