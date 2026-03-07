<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProjectController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $includes = $this->parseIncludes($request, ['technologies']);

        $projects = Project::query()
            ->published()
            ->ordered()
            ->when($includes, fn ($q) => $q->with($includes))
            ->paginate();

        return ProjectResource::collection($projects);
    }

    public function show(Request $request, Project $project): ProjectResource
    {
        return new ProjectResource($project);
    }

    /**
     * @param  list<string>  $allowed
     * @return list<string>
     */
    private function parseIncludes(Request $request, array $allowed): array
    {
        if (! $request->has('include')) {
            return [];
        }

        return array_values(array_intersect(
            explode(',', $request->query('include')),
            $allowed
        ));
    }
}
