<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $data=$request->validate(['body'=>'required']);

        $comment = Comment::create([
            'body'       => $data['body'],
            'user_id'    => $request->user()->id,
            'article_id' => $article->id
        ]);

        return new CommentResource($comment->load('user'));
    }

    public function index(Article $article)
    {
        return CommentResource::collection(
            $article->comments()->with('user')->paginate(10)
        );
    }
}
