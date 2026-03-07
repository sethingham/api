<?php

use App\Models\Project;
use App\Models\Technology;

describe('GET /api/v1/technologies', function () {
    it('returns a list of technologies in JSON:API format', function () {
        $tech = Technology::factory()->create(['name' => 'Laravel']);

        $this->getJson('/api/v1/technologies')
            ->assertOk()
            ->assertHeader('Content-Type', JSON_API_CONTENT_TYPE)
            ->assertJsonPath('data.0.id', (string) $tech->id)
            ->assertJsonPath('data.0.type', 'technologies')
            ->assertJsonPath('data.0.attributes.name', 'Laravel')
            ->assertJsonStructure([
                'data' => [['id', 'type', 'attributes']],
            ]);
    });

    it('returns all technologies without pagination', function () {
        Technology::factory()->count(5)->create();

        $response = $this->getJson('/api/v1/technologies')->assertOk();

        expect($response->json('data'))->toHaveCount(5);
        expect($response->json())->not->toHaveKey('meta');
    });

    it('does not include relationships without the include parameter', function () {
        Technology::factory()->create();

        $response = $this->getJson('/api/v1/technologies')->assertOk();

        expect($response->json('data.0'))->not->toHaveKey('relationships');
        expect($response->json())->not->toHaveKey('included');
    });

    it('includes projects when requested', function () {
        $tech = Technology::factory()->create();
        $project = Project::factory()->published()->create();
        $tech->projects()->attach($project);

        $this->getJson('/api/v1/technologies?include=projects')
            ->assertOk()
            ->assertJsonPath('data.0.relationships.projects.data.0.id', (string) $project->id)
            ->assertJsonPath('data.0.relationships.projects.data.0.type', 'projects')
            ->assertJsonPath('included.0.id', (string) $project->id)
            ->assertJsonPath('included.0.attributes.title', $project->title);
    });

    it('returns an empty projects relationship when none are attached', function () {
        Technology::factory()->create();

        $this->getJson('/api/v1/technologies?include=projects')
            ->assertOk()
            ->assertJsonPath('data.0.relationships.projects.data', []);
    });
});
