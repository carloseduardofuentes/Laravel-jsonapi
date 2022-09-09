<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ArticleCollection extends ResourceCollection
{
    
    public function toArray($request)
    {
       return [
            'data' => ArticleResource::collection($this->collection),
            'links' => [
                'self' => route('api.v1.articles.index')
            ],
            'meta' => [
                'articles_count' => $this->collection->count()
            ],
        ];
    }
}
