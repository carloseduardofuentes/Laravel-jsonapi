<?php

namespace Tests\Feature\Articles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListArticleTest extends TestCase
{
    use RefreshDatabase;
    /* @test */
    public function can_fetch_single_article()
    {        
        $this->withoutExceptionHandling();
        
        $article = factory(Article::class)->create();

        //Conocer los tipos de datos del json usando "dump"
        //$response=$this->getJson('/api/v1/articles/'.$article->getRouteKey())->dump();
        $response=$this->getJson(route('api.v1.articles.show',$article));

        //$response->assertSee($article->title);

        //para validar formato correcto de json "assertExactJson"
        $response->assertExactJson([
            'data' => [
                'type' => 'articles',
                'id' => (string) $article->getRouteKey(),
                'attributes' => [
                    'title' => $article->title,
                    'slug' => $article->slug,
                    'content' => $article->content,
                ], 
                'links'=> [
                    //'self' => url('/api/v1/articles/'.$article->getRouteKey())
                    'self' => route('api.v1.articles.show',$article)
                ]           
            ] 
        ]);
        
    }

    public function can_fetch_all_articles()
    {        
        $this->withoutExceptionHandling();
        
        $articles = factory(Article::class)->times(3)->create();
       
        $response=$this->getJson(route('api.v1.articles.index'));

        //para validar formato correcto de json "assertExactJson"
        $response->assertExactJson([
            'data' => [
                [
                    'type' => 'articles',
                    'id' => (string) $articles[0]->getRouteKey(),
                    'attributes' => [
                    'title' => $articles[0]->title,
                    'slug' => $articles[0]->slug,
                    'content' => $articles[0]->content,
                    ], 
                    'links'=> [
                        //'self' => url('/api/v1/articles/'.$article->getRouteKey())
                        'self' => route('api.v1.articles.show',$article)
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $articles[1]->getRouteKey(),
                    'attributes' => [
                    'title' => $articles[1]->title,
                    'slug' => $articles[1]->slug,
                    'content' => $articles[1]->content,
                    ], 
                    'links'=> [
                        //'self' => url('/api/v1/articles/'.$article->getRouteKey())
                        'self' => route('api.v1.articles.show',$article)
                    ]
                ],
                [
                    'type' => 'articles',
                    'id' => (string) $articles[2]->getRouteKey(),
                    'attributes' => [
                    'title' => $articles[2]->title,
                    'slug' => $articles[2]->slug,
                    'content' => $articles[2]->content,
                    ], 
                    'links'=> [
                        //'self' => url('/api/v1/articles/'.$article->getRouteKey())
                        'self' => route('api.v1.articles.show',$article)
                    ]
                ],         
            ],
            'links' => [
                'self' => route('api.v1.articles.index')
            ],
            'meta' => [
                'articles_count' => 3
            ],
        ]);
        
    }
}
