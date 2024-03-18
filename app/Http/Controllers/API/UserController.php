<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
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
    public function store(Request $request)
    {
        $user = User::create([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        if ($request->image) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->extension();
            $image->move(public_path('images/users'), $imageName);
            $user->update([
                'image' => $imageName
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Utilisateurs créé avec succès',
            'user' => $user,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        // Rechercher l'utilisateur spécifique par son ID
        $user = User::with('comments', 'favoris', 'reservations')->find($user->id);

        if (!$user) {
            return response()->json([
                'status' => false,
                'message' => 'Utilisateur non trouvé',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur récupéré avec succès',
            'user' => $user,
        ], 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(), [
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'email' => 'nullable|email|max:50',
            'oldPassword' => 'nullable',
            'password' => [
                'nullable', 'confirmed',
                Password::min(8) // minimum 8 caractères   
                    ->mixedCase() // au moins 1 minuscule et une majuscule
                    ->letters()  // au moins une lettre
                    ->numbers() // au moins un chiffre
                    ->symbols() // au moins un caractère spécial     
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048'
        ]);

        // renvoi d'un ou plusieurs messages d'erreur si champ(s) incorrect(s)
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }


        $user->update(
            $request->all()
        );

        if ($request->password) {

            // si ancien mdp fourni ET valide (vérifié via Hash::check), modification validée 
            if ($request->oldPassword && Hash::check($request->oldPassword, User::find($user->id)->password)) {
                // on sauvegarde le nouveau mot de passe hashé
                $user->update([
                    'password' => Hash::make($request->password)
                ]);

                // sinon => on renvoie une erreur
            } else {
                return response()->json(['mot de passe actuel non renseigné ou incorrect'], 400);
            }
        }

        if ($request->image) {

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
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'Utilisateur supprimé avec succès',
            'user' => $user,
        ], 201);
    }
}
