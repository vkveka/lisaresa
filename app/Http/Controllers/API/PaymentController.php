<?php

namespace App\Http\Controllers\API;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::with('user', 'reservation')->get();

        return response()->json([
            'status' => true,
            'message' => 'Les paiements ont été récupérés',
            'payments' => $payments,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request)
    {
        $payment = Payment::create(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'Le paiement a été crée',
            'payments' => $payment,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        $payment = Payment::with('user', 'reservation')->find($payment->id);

        return response()->json([
            'status' => true,
            'message' => 'Le paiement a été récupéré',
            'payments' => $payment,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
        $payment->update(
            $request->all()
        );

        return response()->json([
            'status' => true,
            'message' => 'Le paiement a été modifié',
            'payments' => $payment,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        $payment->delete();

        return response()->json([
            'status' => true,
            'message' => 'Le paiement a été supprimé',
            'payments' => $payment,
        ]);
    }
}
