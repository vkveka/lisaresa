<?php

namespace App\Http\Controllers\API;

use App\Models\Accomodation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AccomodationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $accomodations = Accomodation::with('comments', 'images', 'options')->get();

        return response()->json([
            'status' => true,
            'message' => 'Logements récupérés avec succès',
            'accomodations' => $accomodations,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $accomodation = Accomodation::create([
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'price' => $request->price,
            'dispo' => $request->dispo,
            'address' => $request->address,
            'cp' => $request->cp,
            'city' => $request->city,
            'country' => $request->country,
            'superficy' => $request->superficy,
            'rooms' => $request->rooms,
            'beds' => $request->beds,
            'persons' => $request->persons,
            'note' => $request->note,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Logement créé avec succès',
            'accomodation' => $accomodation,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Accomodation $accomodation)
    {
        $accomodations = Accomodation::with('comments', 'images', 'options')->find($accomodation->id);

        return response()->json([
            'status' => true,
            'message' => 'Logement récupéré avec succès',
            'accomodations' => $accomodations,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Accomodation $accomodation)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'nullable',
            'description' => 'nullable',
            'type' => 'nullable',
            'price' => 'nullable',
            'dispo' => 'nullable',
            'address' => 'nullable',
            'cp' => 'nullable',
            'city' => 'nullable',
            'country' => 'nullable',
            'superficy' => 'nullable',
            'rooms' => 'nullable',
            'beds' => 'nullable',
            'persons' => 'nullable',
            'note' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        $accomodation->update(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'Logement modifié avec succès',
            'accomodation' => $accomodation,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accomodation $accomodation)
    {
        $accomodation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Le logement a bien été supprimé',
            'accomodation' => $accomodation,
        ]);
    }
}
