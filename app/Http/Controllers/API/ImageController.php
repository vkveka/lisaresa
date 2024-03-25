<?php

namespace App\Http\Controllers\API;

use App\Models\Image;
use App\Models\Accomodation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

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
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreImageRequest $request)
    {
        $accomodation_id = $request->accomodation_id;
        // on récupère le nombre d'images pour ce logement
        $imagesTotalForAccomodation = Image::where('accomodation_id', $request->accomodation_id)->count();

        // on accède au tableau d'images transmises via le formulaire
        $images = $request->file('name');
        // on stocke les noms des images pour les renvoyer
        $imagesNames = [];
        if ($images) {
            foreach ($images as $key => $image) {  // on boucle sur les images uploadées

                $imageName = $accomodation_id . "_" . $imagesTotalForAccomodation + $key + 1  . '.' . $image->getClientOriginalExtension();
                // $imageInfos = getimagesize($imageName);
                // $fileSize = round(filesize($image) / 1000);

                $destinationPath = public_path("images/accomodations/{$accomodation_id}");
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0755, true, true);
                }


                $image->move($destinationPath, $imageName);

                // on stocke le(s) nom(s) de(s) l'image(images) dans le tableau
                array_push($imagesNames, $imageName);

                Image::create([
                    'name' => $imageName,
                    'accomodation_id' => $request->accomodation_id,
                ]);
            }
        }

        return response()->json([
            'status' => true,
            'message' => count($imagesNames) . ' image(s) ont été ajoutées avec succès',
            'images' => $imagesNames,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('accomodation');

        return response()->json([
            'status' => true,
            'message' => 'L\'images a été récupérée',
            'images' => $image,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        $newImage = $request->file('name');

        if ($newImage) {
            $imageName = pathinfo($image->name, PATHINFO_FILENAME) . '.' . $newImage->getClientOriginalExtension();
            File::delete(public_path("images/accomodations/{$image->accomodation_id}/{$image->name}"));
            $destinationPath = public_path("images/accomodations/{$image->accomodation_id}");

            $newImage->move($destinationPath, $imageName);

            $image->update([
                'name' => $imageName,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'L\'image a été modifiée avec succès',
            'images' => $image,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        if ($image->name && File::exists(public_path("images/accomodations/{$image->accomodation_id}/{$image->name}"))) {
            File::delete(public_path("images/accomodations/{$image->accomodation_id}/{$image->name}"));
        }

        $image->delete();

        return response()->json([
            'status' => true,
            'message' => 'L\'images a été supprimée',
            'images' => $image,
        ], 200);
    }
}
