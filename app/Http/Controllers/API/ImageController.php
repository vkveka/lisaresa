<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $images = Image::with('accomodation')->get();

        return response()->json([
            'status' => true,
            'message' => 'Toutes les images ont été récupérées',
            'images' => $images,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // on récupère le nombre d'images pour ce lieu
        $imagesTotalForPlace = Image::where('lieu_id', $request->lieu_id)->count();

        // on accède au tableau d'images transmises via le formulaire
        $images = $request->file('images');

        // on stocke les noms des images pour les renvoyer
        $imagesNames = [];

        foreach ($images as $key => $image) {  // on boucle sur les images uploadées

            //nom de l'image = nom du lieu (espaces changés en underscores) + _image_ + le N° de l'image pour ce lieu + l'extension
            $imageName = str_replace(' ', '_', $request->nom) . "_image_" . $imagesTotalForPlace + $key + 1  . '.' . $image->extension();

            // on récupère les dimensions de l'image
            $imageInfos = getimagesize($image);

            // on récupère le poids en kb de l'image
            $fileSize = round(filesize($image) / 1000);

            // on déplace l'image de son emplacement temporaire vers le dossier public/images
            $image->move(public_path('images'), $imageName);

            // on stocke le(s) nom(s) de(s) l'image(images) dans le tableau
            array_push($imagesNames, $imageName);

            // on sauvegarde l'image en bdd
            Image::create([
                'name' => $imageName,
                'accomodation_id' => $request->accomodation_id,
            ]);
        }

        // on retourne un message de succès et les noms des images uploadées
        $message = count($imagesNames) . " image(s) uploadée(s) avec succès !";
        return $this->sendResponse($imagesNames, $message);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image = Image::with('accomodation')->find($image->id)->get();

        return response()->json([
            'status' => true,
            'message' => 'L\'images a été récupérée',
            'images' => $image,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'L\'images a été supprimée',
            'images' => $image,
        ]);
    }
}
