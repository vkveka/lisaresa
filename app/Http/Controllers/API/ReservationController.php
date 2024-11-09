<?php

namespace App\Http\Controllers\API;

use App\Models\Reservation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;

class ReservationController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->except('index', 'show', 'getResaForUser', 'store');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::with('accomodation', 'user')->get();

        return response()->json([
            'status' => true,
            'message' => 'Les reservations ont bien été récupérées',
            'reservations' => $reservations,
        ], 200);
    }

    public function getResaForUser()
    {
        $userId = auth()->id();

        $reservations = Reservation::with('accomodation', 'user')
            ->where('user_id', $userId)
            ->get();

        return response()->json([
            'status' => true,
            'message' => 'Les réservations ont bien été récupérées',
            'reservations' => $reservations,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $reservation = Reservation::create([
            'date_in' => $request->date_in,
            'date_out' => $request->date_out,
            'price' => $request->price,
            'numero' => $request->numero,
            'user_id' => $request->user_id,
            'accomodation_id' => $request->accomodation_id,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'La reservation a bien été créée',
            'reservations' => $reservation,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        $reservation->load('accomodation', 'user');

        return response()->json([
            'status' => true,
            'message' => 'La reservation a bien été récupérée',
            'reservations' => $reservation,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateReservationRequest $request, Reservation $reservation)
    {
        $reservation->update(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'La reservation a bien été modifiée',
            'reservations' => $reservation,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $reservation->delete();

        return response()->json([
            'status' => true,
            'message' => 'La reservation a bien été supprimée',
            'reservations' => $reservation,
        ], 200);
    }
}
