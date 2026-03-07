<?php

use App\Models\About;

describe('GET /api/v1/about', function () {
    it('returns the about record in JSON:API format', function () {
        $about = About::factory()->create();

        $this->getJson('/api/v1/about')
            ->assertOk()
            ->assertHeader('Content-Type', JSON_API_CONTENT_TYPE)
            ->assertJsonPath('data.id', (string) $about->id)
            ->assertJsonPath('data.type', 'about')
            ->assertJsonStructure([
                'data' => ['id', 'type', 'attributes'],
            ]);
    });

    it('returns correct attributes', function () {
        About::factory()->create([
            'name' => 'Jane Doe',
            'headline' => 'Full Stack Developer',
            'bio' => 'I build things for the web.',
            'avatar' => 'https://example.com/avatar.jpg',
            'email' => 'jane@example.com',
        ]);

        $this->getJson('/api/v1/about')
            ->assertOk()
            ->assertJsonPath('data.attributes.name', 'Jane Doe')
            ->assertJsonPath('data.attributes.headline', 'Full Stack Developer')
            ->assertJsonPath('data.attributes.bio', 'I build things for the web.')
            ->assertJsonPath('data.attributes.avatar', 'https://example.com/avatar.jpg')
            ->assertJsonPath('data.attributes.email', 'jane@example.com');
    });

    it('returns null for avatar when not set', function () {
        About::factory()->create(['avatar' => null]);

        $this->getJson('/api/v1/about')
            ->assertOk()
            ->assertJsonPath('data.attributes.avatar', null);
    });

    it('returns 404 when no about record exists', function () {
        $this->getJson('/api/v1/about')->assertNotFound();
    });
});
