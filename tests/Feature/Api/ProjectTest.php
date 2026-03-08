<?php

use App\Models\Project;
use App\Models\Technology;

const JSON_API_CONTENT_TYPE = 'application/vnd.api+json';

describe('GET /v1/projects', function () {
    it('returns a list of published projects in JSON:API format', function () {
        $project = Project::factory()->published()->create();
        Project::factory()->draft()->create();

        $this->getJson('/v1/projects')
            ->assertOk()
            ->assertHeader('Content-Type', JSON_API_CONTENT_TYPE)
            ->assertJsonPath('data.0.id', (string) $project->id)
            ->assertJsonPath('data.0.type', 'projects')
            ->assertJsonStructure([
                'data' => [['id', 'type', 'attributes']],
                'links' => ['first', 'last', 'prev', 'next'],
                'meta' => ['total', 'current_page', 'per_page', 'last_page'],
            ]);
    });

    it('does not return draft projects', function () {
        Project::factory()->draft()->count(3)->create();

        $this->getJson('/v1/projects')
            ->assertOk()
            ->assertJsonCount(0, 'data');
    });

    it('returns projects ordered by sort_order', function () {
        $second = Project::factory()->published()->create(['sort_order' => 2]);
        $first = Project::factory()->published()->create(['sort_order' => 1]);

        $this->getJson('/v1/projects')
            ->assertOk()
            ->assertJsonPath('data.0.id', (string) $first->id)
            ->assertJsonPath('data.1.id', (string) $second->id);
    });

    it('returns correct project attributes', function () {
        $project = Project::factory()->published()->create([
            'title' => 'My Project',
            'excerpt' => 'Short summary',
            'is_featured' => true,
        ]);

        $this->getJson('/v1/projects')
            ->assertOk()
            ->assertJsonPath('data.0.attributes.title', 'My Project')
            ->assertJsonPath('data.0.attributes.excerpt', 'Short summary')
            ->assertJsonPath('data.0.attributes.is_featured', true);
    });

    it('does not include relationships without the include parameter', function () {
        Project::factory()->published()->create();

        $response = $this->getJson('/v1/projects')->assertOk();

        expect($response->json('data.0'))->not->toHaveKey('relationships');
        expect($response->json())->not->toHaveKey('included');
    });

    it('includes technologies when requested', function () {
        $tech = Technology::factory()->create(['name' => 'Laravel']);
        $project = Project::factory()->published()->create();
        $project->technologies()->attach($tech);

        $this->getJson('/v1/projects?include=technologies')
            ->assertOk()
            ->assertJsonPath('data.0.relationships.technologies.data.0.id', (string) $tech->id)
            ->assertJsonPath('data.0.relationships.technologies.data.0.type', 'technologies')
            ->assertJsonPath('included.0.id', (string) $tech->id)
            ->assertJsonPath('included.0.type', 'technologies')
            ->assertJsonPath('included.0.attributes.name', 'Laravel');
    });

    it('includes technologies for each project that has them', function () {
        $tech = Technology::factory()->create();
        $projectA = Project::factory()->published()->create(['sort_order' => 1]);
        $projectB = Project::factory()->published()->create(['sort_order' => 2]);
        $projectA->technologies()->attach($tech);
        $projectB->technologies()->attach($tech);

        $this->getJson('/v1/projects?include=technologies')
            ->assertOk()
            ->assertJsonPath('data.0.relationships.technologies.data.0.id', (string) $tech->id)
            ->assertJsonPath('data.1.relationships.technologies.data.0.id', (string) $tech->id);
    });

    it('returns paginated results', function () {
        Project::factory()->published()->count(20)->create();

        $this->getJson('/v1/projects')
            ->assertOk()
            ->assertJsonPath('meta.total', 20)
            ->assertJsonPath('meta.per_page', 15)
            ->assertJsonPath('meta.last_page', 2);
    });
});

describe('GET /v1/projects/{project}', function () {
    it('returns a single project in JSON:API format', function () {
        $project = Project::factory()->published()->create();

        $this->getJson("/v1/projects/{$project->id}")
            ->assertOk()
            ->assertHeader('Content-Type', JSON_API_CONTENT_TYPE)
            ->assertJsonPath('data.id', (string) $project->id)
            ->assertJsonPath('data.type', 'projects')
            ->assertJsonStructure(['data' => ['id', 'type', 'attributes']]);
    });

    it('returns correct project attributes', function () {
        $project = Project::factory()->published()->create([
            'title' => 'My Project',
            'url' => 'https://example.com',
            'is_featured' => false,
        ]);

        $this->getJson("/v1/projects/{$project->id}")
            ->assertOk()
            ->assertJsonPath('data.attributes.title', 'My Project')
            ->assertJsonPath('data.attributes.url', 'https://example.com')
            ->assertJsonPath('data.attributes.is_featured', false);
    });

    it('returns 404 for a non-existent project', function () {
        $this->getJson('/v1/projects/999')->assertNotFound();
    });

    it('does not include relationships without the include parameter', function () {
        $project = Project::factory()->published()->create();

        $response = $this->getJson("/v1/projects/{$project->id}")->assertOk();

        expect($response->json('data'))->not->toHaveKey('relationships');
        expect($response->json())->not->toHaveKey('included');
    });

    it('includes technologies when requested', function () {
        $tech = Technology::factory()->create(['name' => 'Vue']);
        $project = Project::factory()->published()->create();
        $project->technologies()->attach($tech);

        $this->getJson("/v1/projects/{$project->id}?include=technologies")
            ->assertOk()
            ->assertJsonPath('data.relationships.technologies.data.0.id', (string) $tech->id)
            ->assertJsonPath('included.0.attributes.name', 'Vue');
    });

    it('returns an empty technologies relationship when none are attached', function () {
        $project = Project::factory()->published()->create();

        $this->getJson("/v1/projects/{$project->id}?include=technologies")
            ->assertOk()
            ->assertJsonPath('data.relationships.technologies.data', []);
    });
});
