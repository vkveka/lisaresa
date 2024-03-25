<?php

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\AccomodationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("users", UserController::class);
Route::apiResource("accomodations", AccomodationController::class);
Route::apiResource("comments", CommentController::class);
Route::apiResource("options", OptionController::class);
Route::apiResource("reservations", ReservationController::class);
Route::apiResource("payments", PaymentController::class);
Route::apiResource("images", ImageController::class);

// réponse renvoyée en cas de demande d'une route non-existante (ereur 404)
Route::fallback(function () {
    return response()->json([
        'message' => 'Page non trouvée. Si l\'erreur persiste, contactez l\'administrateur : admin@reseausocial.fr'
    ], 404);
});
