<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Asset
{
  public static function create($picturePath) {
    $folder = dirname($picturePath);
    $absolutePath = Storage::path($picturePath);
    $img = Image::make($absolutePath)->orientate();
    $img->resize(400, 400, function ($constraint) {
      $constraint->aspectRatio();
      $constraint->upsize();
    });
    $assetPath = "$folder/{$img->filename}_400.$img->extension";
    Storage::put($assetPath, $img->encode());
    return $assetPath;
  }
}
