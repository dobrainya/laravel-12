<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReferenceResource;
use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ReferenceController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return ReferenceResource::collection(Reference::all());
    }

    public function show(int $id): ReferenceResource
    {
        return new ReferenceResource(Reference::findOrFail($id));
    }
}
