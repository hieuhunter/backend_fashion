<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Comment;
use App\Models\Product;
use App\Transformers\ListComment\ListCommentTransformers;
use App\Transformers\CreateComment\CreateCommentTransformers;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    public function listComment(Request $request, $limit = 5, $offset = 0)
    {
        $limit = $request->get('limit', $limit);
        $offset = $request->get('offset', $offset);

        $comment = Comment::whereHas('product', function ($q) use ($request) {
            $q->where('id', $request->product_id);
        });

        $commentsCount = $comment->get()->count();
        $commentsCountParent = $comment->whereNull('parent_id')->get()->count();
        $listComment = fractal($comment->whereNull('parent_id')->orderBy('created_at', 'desc')->skip($offset)->take($limit)->get(), new ListCommentTransformers);

        return response()->json([
            'success' => true,
            'data' => $listComment,
            'meta' => [
                'total' => $commentsCount,
                'total_parent' => $commentsCountParent
            ]
        ]);
    }

    public function createComment(CreateCommentRequest $request)
    {
        $comment = new Comment;
        $comment->id_sp = Product::where('id', $request->product_id)->first()->id;
        $comment->id_kh = auth()->user()->id;
        $comment->slug = Str::lower(Str::random(5));
        $comment->content = $request->content;
        $comment->published = 1;
        if ($request->has('parent_id')) {
            $comment->parent_id = $request->parent_id;
        }
        $comment->save();
        $createComment = fractal(Comment::where('id', $comment->id)->firstOrFail(), new CreateCommentTransformers);

        return response()->json([
            'success' => true,
            'data' => $createComment,
        ]);
    }
    
    public function deleteComment(Request $request, $id)
    {
        $comment = Comment::where('id', $id)->where('id_kh', auth()->user()->id)->first();            
        $comment->delete();
        return response()->json([
            'success' => true,
            'data' => $comment,
        ]);
    }

}
