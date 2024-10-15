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

    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'admin']);
    }

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

        // Récupère le nombre de photos correspondantes à un logement
        // $imagesTotalForAccomodation = Image::where('accomodation_id', $request->accomodation_id)->count();

        $imagesMaxIndexes = Image::where('accomodation_id', $request->accomodation_id)->pluck('index')->max();

        // on accède au tableau d'images transmises via le formulaire
        $images = $request->file('name');

        // on stocke les noms des images pour les renvoyer
        $imagesNames = [];

        if ($images) {
            $index = $imagesMaxIndexes + 1;
            // $imagesTotalSize = 0;
            foreach ($images as $key => $image) {

                // Incrémente de 1 le nombre d'images correspondantes au logement
                // $imageName = $accomodation_id . "_" . $imagesTotalForAccomodation + $key + 1  . '.' . $image->getClientOriginalExtension();

                $imageName = $accomodation_id . "_" . time() . $key . '.' . $image->getClientOriginalExtension();
                // dd($imageName);
                // $fileSize = filesize($image) / 1000;
                // $imagesTotalSize += $fileSize;

                $destinationPath = public_path("images/accomodations/{$accomodation_id}");
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, $mode = 0755, true, true);
                }


                $image->move($destinationPath, $imageName);

                // on stocke le(s) nom(s) de(s) l'image(images) dans le tableau
                array_push($imagesNames, $imageName);

                Image::create([
                    'name' => $imageName,
                    'index' => $index,
                    'accomodation_id' => $request->accomodation_id,
                ]);
                $index++;
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
        $newIndex = (int)$request->index;

        if ($newImage) {
            $imageName = pathinfo($image->name, PATHINFO_FILENAME) . '.' . $newImage->getClientOriginalExtension();
            File::delete(public_path("images/accomodations/{$image->accomodation_id}/{$image->name}"));
            $destinationPath = public_path("images/accomodations/{$image->accomodation_id}");

            $newImage->move($destinationPath, $imageName);

            $image->update([
                'name' => $imageName,
            ]);
        }

        if ($newIndex) {
            $getImagesIndexes = Image::where('accomodation_id', $image->accomodation_id)->get();

            foreach ($getImagesIndexes as $getImageIndex) {
                if ($newIndex > $image->index) {
                    if ($getImageIndex->index > $image->index && $getImageIndex->index <= $newIndex) {
                        $getImageIndex->update([
                            'index' => $getImageIndex->index - 1,
                        ]);
                    }
                }
                // si l'index récupéré est plus grand que le nouvel index, on ne fait rien
                // si l'index récupéré est plus petit que l'index initial de l'image, on ne fait rien
                if ($newIndex < $image->index) {
                    if ($getImageIndex->index >= $newIndex && $getImageIndex->index < $image->index) {
                        $getImageIndex->update([
                            'index' => $getImageIndex->index + 1,
                        ]);
                    }
                }
                // si l'index récupéré est plus petit que le nouvel index, on ne fait rien
                // si l'index récupéré est plus grand que l'index initial de l'image, on ne fait rien
            }

            $image->update([
                'index' => $newIndex,
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'L\'image a été modifiée avec succès',
            'image' => $image,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        $getImagesIndexes = Image::where('accomodation_id', $image->accomodation_id)
            ->where('index', '>', $image->index)
            ->get();

        foreach ($getImagesIndexes as $imageIndex) {
            $imageIndex->update([
                'index' => $imageIndex->index - 1,
            ]);
        }
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
