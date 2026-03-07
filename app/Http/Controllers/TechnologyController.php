<?php

namespace App\Http\Controllers;

use App\Http\Resources\TechnologyResource;
use App\Models\Technology;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TechnologyController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $includes = $this->parseIncludes($request, ['projects']);

        $technologies = Technology::query()
            ->when($includes, fn ($q) => $q->with($includes))
            ->get();

        return TechnologyResource::collection($technologies);
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
