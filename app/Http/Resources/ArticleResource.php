<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
   
    public function toArray($request)
    {
        return [
            
                'type' => 'articles',
                'id' => (string) $this->resource->getRouteKey(),
                'attributes' => [
                    'title' => $this->resource->title,
                    'slug' => $this->resource->slug,
                    'content' => $this->resource->content,
                ], 
                'links'=> [
                    //'self' => url('/api/v1/articles/'.$article->getRouteKey())
                    'self' => route('api.v1.articles.show',$this->resource)
                ]           
             
        ];
    }
}
