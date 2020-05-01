<?php

namespace App\Http\Controllers;


use App\User;
use App\FilesUpload;
use Intervention\Image\Facades\Image;
use Illuminate\Http\Request;


class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //return $_FILES;

        $user = auth()->user();
        $target_dir = "../public/images/profiles/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


        //vérifier si c'est une image

        $check = getimagesize($_FILES["image"]["tmp_name"]);

        if($check !== false) {
            $uploadOk = 1;
        } else {
            $errors = ["error" => "vous n'avez pas choisis une photo"];
            return $errors;
            $uploadOk = 0;
        }

        //vérifier la taille de l'image

        if ($_FILES["image"]["size"] > 500000) {
            $errors = ["error" => "Votre image est trop volumineuse"];
            return $errors;
            $uploadOk = 0;
        }

        // vérifier le format de l'image

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            $errors = ["error" => "Votre image n'est pas de type jpg/png/jpeg/gif"];
            return $errors;

            $uploadOk = 0;
        }

        // déplacer l'image dans le bon dossier

        if ($uploadOk == 0) {
            return  "il y a eu un problème";
        } else {
            // return "image upload";
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $user->profilPic = $_FILES["image"]["name"];
                $user->save();
            } else {
                return "l'image n'a pas été upload";
            }

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
