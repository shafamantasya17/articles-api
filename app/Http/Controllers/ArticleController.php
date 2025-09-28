<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\ArticleResource;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with('author');

        if ($search = $request->query('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title','like',"%{$search}%")
                ->orWhere('body','like',"%{$search}%");
            });
        }

        return ArticleResource::collection($query->paginate(10));
    }

    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);
        $article=$request->user()->articles()->create($data);

        return new ArticleResource($article);
    }

    public function show(Article $article)
    {
        $article->load('author','comments.user');

        return new ArticleResource($article);
    }

    public function update(Request $request, Article $article)
    {
        if($request->user()->id !== $article->author_id){
            return response()->json(['error'=>'Unauthorized'],403);
        }
        $data=$request->validate(['title'=>'required','body'=>'required']);
        $article->update($data);

        return new ArticleResource($article);
    }

    public function destroy(Request $request, Article $article)
    {
        if($request->user()->id !== $article->author_id){
            return response()->json(['error'=>'Unauthorized'],403);
        }
        $article->delete();
        return response()->json(['message'=>'Deleted']);
    }
}