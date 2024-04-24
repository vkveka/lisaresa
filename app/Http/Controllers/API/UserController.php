<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('store');
        $this->middleware('admin')->except('store', 'update', 'destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('comments', 'favoris', 'reservations')->get();

        return response()->json([
            'status' => true,
            'message' => 'Utilisateurs récupérés avec succès',
            'users' => $users,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/users'), $imageName);
        } else {
            $imageName = 'user.png';
        }

        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'image' => $imageName,
            'password' => $request->password,
        ]);


        return response()->json([
            'status' => true,
            'message' => 'Utilisateur créé avec succès',
            'user' => $user,
        ], 201);
    }


    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $user->load('comments', 'favoris', 'reservations');

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur récupéré avec succès',
            'user' => $user,
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update(
            $request->except('image', 'password')
        );

        if ($request->password) {
            // si ancien mdp fourni ET valide (vérifié via Hash::check), modification validée 
            if ($request->oldPassword && Hash::check($request->oldPassword, User::find($user->id)->password)) {
                $user->update([
                    'password' => Hash::make($request->password)
                ]);
            } else {
                // erreur 400 => formulaire mal rempli. Erreur côté client
                return response()->json(['Mot de passe actuel non renseigné ou incorrect'], 400);
            }
        }

        if ($request->image) {
            if ($user->image && File::exists(public_path("images/users/{$user->image}"))) {
                File::delete(public_path("images/users/{$user->image}"));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/users'), $imageName);
            $user->update([
                'image' => $imageName
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Utilisateurs modifié avec succès',
            'user' => $user,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->image && File::exists(public_path("images/users/{$user->image}"))) {
            File::delete(public_path("images/users/{$user->image}"));
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur supprimé avec succès',
            'user' => $user,
        ], 200);
    }
}
