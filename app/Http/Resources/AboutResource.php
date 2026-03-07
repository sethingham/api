<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\JsonApi\JsonApiResource;

class AboutResource extends JsonApiResource
{
    public function toType(Request $request): string
    {
        return 'about';
    }

    /**
     * @return array<string, mixed>
     */
    public function toAttributes(Request $request): array
    {
        return [
            'name' => $this->name,
            'headline' => $this->headline,
            'bio' => $this->bio,
            'avatar' => $this->avatar,
            'email' => $this->email,
        ];
    }
}
