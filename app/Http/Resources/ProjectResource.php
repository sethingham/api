<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class ProjectResource extends JsonApiResource
{
    public function toType(Request $request): string
    {
        return 'projects';
    }

    /**
     * @return array<string, mixed>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'description' => $this->description,
            'image' => $this->image,
            'url' => $this->url,
            'is_featured' => $this->is_featured,
            'sort_order' => $this->sort_order,
            'published_at' => $this->published_at?->toIso8601String(),
        ];
    }

    /**
     * @return array<string, class-string>
     */
    public function toRelationships(Request $request): array
    {
        return [
            'technologies' => TechnologyResource::class,
        ];
    }
}
