<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Laravel tente de connecter l'utilisateur si l'email existe ET si le mdp en clair correspond à celui hashé
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            // Si la connexion fonctionne, on récupère l'utilisateur et on charge son rôle
            $authUser = User::find(Auth::user()->id);
            $authUser->load('role');

            return response()->json([
                "user" => $authUser,
                "message" => 'Vous êtes connecté'
            ]);
        } else {
            return response()->json([
                'Echec de la connexion',
                'errors' => 'L\'utilisateur n\'existe pas ou le mot de passe est incorrect'
            ]);
        }
    }

    public function logout(Request $request)
    {
        // déconnecte de la session en cours et invalide le token du cookie de session
        Auth::guard('web')->logout();

        return response()->json([
            'status' => true,
            'message' => 'Déconnexion réussie'
        ]);
    }
}
