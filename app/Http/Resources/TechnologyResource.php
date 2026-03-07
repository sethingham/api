<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class TechnologyResource extends JsonApiResource
{
    public function toType(Request $request): string
    {
        return 'technologies';
    }

    /**
     * @return array<string, mixed>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
        ];
    }

    /**
     * @return array<string, class-string>
     */
    public function toRelationships(Request $request): array
    {
        return [
            'projects' => ProjectResource::class,
        ];
    }
}
