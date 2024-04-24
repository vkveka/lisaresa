<?php

namespace App\Http\Controllers\API;

use App\Models\Accomodation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreAccomodationRequest;
use App\Http\Requests\UpdateAccomodationRequest;

class AccomodationController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
        $this->middleware('admin')->except('index', 'show');
    }

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
    public function store(StoreAccomodationRequest $request)
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
        $accomodation->load('comments', 'images', 'options');

        return response()->json([
            'status' => true,
            'message' => 'Logement récupéré avec succès',
            'accomodations' => $accomodation,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccomodationRequest $request, Accomodation $accomodation)
    {
        $accomodation->update(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'Logement modifié avec succès',
            'accomodation' => $accomodation,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accomodation $accomodation)
    {
        if (File::exists(public_path("images/accomodations/{$accomodation->id}"))) {
            File::deleteDirectory(public_path("images/accomodations/{$accomodation->id}"));
        }

        $accomodation->delete();

        return response()->json([
            'status' => true,
            'message' => 'Le logement a bien été supprimé',
            'accomodation' => $accomodation,
        ], 200);
    }
}
