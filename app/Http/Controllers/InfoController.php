<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InfoController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        return response()->json([
            'name' => "Seth's Portfolio API",
            'version' => 'v1',
            'docs' => 'https://github.com/sethingham/api',
            'endpoints' => [
                'profile' => url('/v1/profile'),
                'projects' => url('/v1/projects'),
                'technologies' => url('/v1/technologies'),
            ],
        ]);
    }
}
