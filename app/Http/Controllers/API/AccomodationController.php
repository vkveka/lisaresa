<?php

namespace App\Http\Controllers\API;

use App\Models\Reservation;
use App\Models\Accomodation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Query\JoinClause;
use App\Http\Requests\StoreAccomodationRequest;
use App\Http\Requests\UpdateAccomodationRequest;

class AccomodationController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show', 'accomodationFromSearch');
        $this->middleware('auth:sanctum')->except('index', 'show', 'accomodationFromSearch');
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

    public function accomodationFromSearch(Request $request)
    {
        $location_id = $request->location_id;
        $date_in = $request->date_in;
        $date_out = $request->date_out;

        // $accomodations = DB::table('accomodations')->select('accomodations.*')
        //     ->where('location_id', $location_id)
        //     ->join('reservations', function (JoinClause $join) use ($date_in, $date_out) {
        //         $join->on('accomodations.id', '=', 'reservations.accomodation_id')
        //             ->where('reservations.date_in', '>', $date_out)->orWhere('reservations.date_out', '<', $date_in);
        //     })->groupBy('accomodations.id')->get();


        $accomodations = DB::table('accomodations')
            ->select('accomodations.*')
            ->where('location_id', $location_id)
            ->whereNotExists(function ($query) use ($date_in, $date_out) {
                $query->select(DB::raw(1))
                    ->from('reservations')
                    ->whereRaw('reservations.accomodation_id = accomodations.id')
                    ->where(function ($query) use ($date_in, $date_out) {
                        $query->whereBetween('reservations.date_in', [$date_in, $date_out])
                            ->orWhereBetween('reservations.date_out', [$date_in, $date_out])
                            ->orWhere(function ($query) use ($date_in, $date_out) {
                                $query->where('reservations.date_in', '<=', $date_in)
                                    ->where('reservations.date_out', '>=', $date_out);
                            });
                    });
            })
            ->groupBy('accomodations.id')
            ->get();

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
