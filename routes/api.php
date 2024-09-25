<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\OptionController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\PaymentController;
use App\Http\Controllers\API\ReservationController;
use App\Http\Controllers\API\AccomodationController;
use App\Http\Controllers\API\LocationController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::fallback(function () {
    return response()->json([
        'message' => 'Page non trouvée. Si l\'erreur persiste, contactez l\'administrateur : admin@reseausocial.fr'
    ], 404);
});

Route::apiResource("users", UserController::class);
Route::apiResource("comments", CommentController::class)->middleware('auth:sanctum');
Route::apiResource("reservations", ReservationController::class)->middleware('auth:sanctum');
Route::get('accomodations/search', [AccomodationController::class, 'accomodationFromSearch'])->name('accomodations.search');
Route::apiResource("accomodations", AccomodationController::class);
Route::apiResource("options", OptionController::class);
Route::apiResource("payments", PaymentController::class)->middleware('auth:sanctum');
Route::apiResource("images", ImageController::class);
Route::get('locations', [LocationController::class, 'index'])->name('locations');

Route::post('login', [\App\Http\Controllers\API\LoginController::class, 'login'])->name('login');
Route::post('logout', [\App\Http\Controllers\API\LoginController::class, 'logout'])->name('logout')->middleware('auth:web');
