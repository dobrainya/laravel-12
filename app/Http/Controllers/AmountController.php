<?php

namespace App\Http\Controllers;

use App\Http\Resources\AmountResource;
use App\Models\Amount;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AmountController extends Controller
{
    public function index(Request $request): Response
    {
        $data = AmountResource::collection(Amount::all());

        return (new JsonResponse($data->toArray($request)))
            ->setMaxAge(30)
            ->setPublic();
    }

    public function show(int $id): AmountResource
    {
        return new AmountResource(Amount::findOrFail($id));
    }

    public function store(Request $request): AmountResource
    {
        $validated = $request->validate([
            'name' => ['required', 'string'],
            'amount' => ['required', 'decimal:15,2'],
            'type_id' => ['required', 'exists:reference:id'],
        ]);
    }
}
