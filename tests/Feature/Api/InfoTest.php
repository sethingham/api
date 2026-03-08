<?php

describe('GET /v1', function () {
    it('returns api info', function () {
        $this->getJson('/v1')
            ->assertOk()
            ->assertJsonPath('name', "Seth's Portfolio API")
            ->assertJsonPath('version', 'v1')
            ->assertJsonPath('docs', 'https://github.com/sethingham/api')
            ->assertJsonStructure(['name', 'version', 'docs', 'endpoints']);
    });

    it('returns all endpoint urls', function () {
        $this->getJson('/v1')
            ->assertOk()
            ->assertJsonStructure([
                'endpoints' => ['profile', 'projects', 'technologies'],
            ]);
    });
});

describe('404 response', function () {
    it('returns a json 404 for unknown routes', function () {
        $this->getJson('/v1/unknown')
            ->assertNotFound()
            ->assertJsonPath('message', "Sorry! There's nothing here. Visit ".url('/v1').' to learn more.');
    });
});
