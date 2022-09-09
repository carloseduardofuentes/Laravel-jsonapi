<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function show(Article $article)
    {        
        // return response()->json([
        //     'data' => [
        //         'type' => 'articles',
        //         'id' => (string) $article->getRouteKey(),
        //         'attributes' => [
        //             'title' => $article->title,
        //             'slug' => $article->slug,
        //             'content' => $article->content,
        //         ], 
        //         'links'=> [
        //             //'self' => url('/api/v1/articles/'.$article->getRouteKey())
        //             'self' => route('api.v1.articles.show',$article)
        //         ]           
        //     ] 
        // ]);

        return ArticleResource::make($article);
    }
    
    public function index()
    {    
        // return response()->json([
        //     //'data' => Article::all()
        //     'data' => Article::all()->map(function($article){
        //         return  [
        //             'type' => 'articles',
        //             'id' => (string) $article->getRouteKey(),
        //             'attributes' => [
        //                 'title' => $article->title,
        //                 'slug' => $article->slug,
        //                 'content' => $article->content,
        //             ], 
        //             'links'=> [
        //                 //'self' => url('/api/v1/articles/'.$article->getRouteKey())
        //                 'self' => route('api.v1.articles.show',$article)
        //             ]           
        //         ];  
        //     })
             
        // ]);

       $articles=Article::applySorts(request('sort'))->get();

        return ArticleCollection::make(
            //Article::all()
            //Article::orderBy($sortFields, $direction)->get()
            //$articleQuery->get()
            $articles
        );
    }
}
