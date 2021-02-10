<?php

namespace App;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Asset
{
  public static function create($picturePath) {
    $folder = dirname($picturePath);
    $absolutePath = Storage::path($picturePath);
    $img = Image::make($absolutePath);
    $img->resize(300, 300, function ($constraint) {
      $constraint->aspectRatio();
      $constraint->upsize();
    });
    $assetPath = "$folder/{$img->filename}_300.$img->extension";
    Storage::put($assetPath, $img->encode());
  }
}
