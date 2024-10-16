<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

trait imageUploadTrait
{
    /** handle single image upload */
    // public function uploadImage(Request $request, $inputName, $path)
    // {
    //     if($request->hasFile($inputName)){
    //         $image=$request->{$inputName};
    //         $imageName=uniqid().'.'.$image->getClientOriginalExtension();
    //         $image->move(public_path($path),$imageName);
    //         return $path.'/'.$imageName;
    //     }
    // }
    public function uploadImage($request, $imageField, $directory, $width = 300, $height = 300)
    {
        if ($request->file($imageField)) {
            $image = $request->file($imageField);
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $manager = new ImageManager(new Driver());
            $img = $manager->read($image);
            $img->resize($width, $height)->save($directory . '/' . $name_gen);
            return $directory . '/' . $name_gen;
        }
        return null;
    }

    public function deleteImage($path)
    {
        if (file_exists(public_path($path))) {
            unlink(public_path($path));
        }
    }
}
