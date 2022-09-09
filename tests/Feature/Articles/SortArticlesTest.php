<?php

namespace Tests\Feature\Articles;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SortArticlesTest extends TestCase
{
    use RefreshDatabase;
    /* @test */

    public function it_can_sort_articles_by_title_asc()
    {
       
        $article1 = factory(Article::class)->create(['title' => 'C title']);

        $article2 = factory(Article::class)->create(['title' => 'A title']);

        $article3 = factory(Article::class)->create(['title' => 'B title']);
        
        $url=route('api.v1.articles.index',['sort' => 'title']);

        $response=$this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title'
        ]);

    }

    public function it_can_sort_articles_by_title_desc()
    {
       
        $article1 = factory(Article::class)->create(['title' => 'C title']);

        $article2 = factory(Article::class)->create(['title' => 'A title']);

        $article3 = factory(Article::class)->create(['title' => 'B title']);
        
        $url=route('api.v1.articles.index',['sort' => '-title']);

        $response=$this->getJson($url)->assertSeeInOrder([
            'C Title',
            'B Title',
            'A Title'
        ]);

    }

    public function it_can_sort_articles_by_title_and_content()
    {
       
        $article1 = factory(Article::class)->create([
            'title' => 'C title',
            'content' => 'B content'
        ]);

        $article2 = factory(Article::class)->create([
            'title' => 'A title',
            'content' => 'C content'
        ]);

        $article3 = factory(Article::class)->create([
            'title' => 'B title',
            'content' => 'D content'
        ]);

        // \DB::listen(function($db)){
        //     dump($db->sql);
        // }
        
        //$url=route('api.v1.articles.index',['sort' => 'title,content']);
        $url=route('api.v1.articles.index').'?sort=title,-content';

        //dd($url);

        $response=$this->getJson($url)->assertSeeInOrder([
            'A Title',
            'B Title',
            'C Title'
        ]);

        $url=route('api.v1.articles.index').'?sort=-content,title';

        //dd($url);

        $response=$this->getJson($url)->assertSeeInOrder([
            'D content',
            'C content',
            'B content'
        ]);

    }
}
