<?php

use App\Models\Profile;

describe('GET /api/v1/profile', function () {
    it('returns the profile in JSON:API format', function () {
        $profile = Profile::factory()->create();

        $this->getJson('/api/v1/profile')
            ->assertOk()
            ->assertHeader('Content-Type', JSON_API_CONTENT_TYPE)
            ->assertJsonPath('data.id', (string) $profile->id)
            ->assertJsonPath('data.type', 'profile')
            ->assertJsonStructure([
                'data' => ['id', 'type', 'attributes'],
            ]);
    });

    it('returns correct attributes', function () {
        Profile::factory()->create([
            'name' => 'Jane Doe',
            'headline' => 'Full Stack Developer',
            'bio' => 'I build things for the web.',
            'avatar' => 'https://example.com/avatar.jpg',
            'email' => 'jane@example.com',
        ]);

        $this->getJson('/api/v1/profile')
            ->assertOk()
            ->assertJsonPath('data.attributes.name', 'Jane Doe')
            ->assertJsonPath('data.attributes.headline', 'Full Stack Developer')
            ->assertJsonPath('data.attributes.bio', 'I build things for the web.')
            ->assertJsonPath('data.attributes.avatar', 'https://example.com/avatar.jpg')
            ->assertJsonPath('data.attributes.email', 'jane@example.com');
    });

    it('returns null for avatar when not set', function () {
        Profile::factory()->create(['avatar' => null]);

        $this->getJson('/api/v1/profile')
            ->assertOk()
            ->assertJsonPath('data.attributes.avatar', null);
    });

    it('returns 404 when no profile exists', function () {
        $this->getJson('/api/v1/profile')->assertNotFound();
    });
});
