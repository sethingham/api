<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function __invoke(Request $request): AboutResource
    {
        return new AboutResource(About::firstOrFail());
    }
}
