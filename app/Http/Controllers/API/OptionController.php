<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOptionRequest;
use App\Http\Requests\UpdateOptionRequest;
use App\Models\Option;
use Illuminate\Http\Request;

class OptionController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'admin'])->except('index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $options = Option::all();

        return response()->json([
            'status' => true,
            'message' => 'Toutes les options ont été récupérées',
            'options' => $options,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOptionRequest $request)
    {
        $option = Option::create([
            "name" => $request->name,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'L\'option a été ajoutée',
            'option' => $option,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Option $option)
    {
        return response()->json([
            'status' => true,
            'message' => 'L\'option a été récupérée',
            'option' => $option,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOptionRequest $request, Option $option)
    {
        $option->update(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'L\'option a été modifiée',
            'option' => $option,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Option $option)
    {
        $option->delete();

        return response()->json([
            'status' => true,
            'message' => 'L\'option a été supprimée',
            'option' => $option,
        ], 200);
    }
}
