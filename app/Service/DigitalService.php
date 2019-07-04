<?php

namespace App\Service;

class DigitalService
{

    public function uploadFile($file, $location)
    {
        $path = public_path() . "/";

        if (env('APP_ENV') === 'production') {
            $path = "";
        }


        $imageName = time() . $file->getClientOriginalName();


        $file->move($path . 'images/' . $location, $imageName);

        return $imageName;
    }
}
