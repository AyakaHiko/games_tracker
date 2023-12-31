<?php

namespace App\Services;


use App\Services\Interfaces\IImageService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MinIoImageService implements IImageService
{
    public function deleteImage($url){
        try {
            $parsedUrl = parse_url($url);
            $path = ltrim($parsedUrl['path'], '/');

            Storage::disk('minio')->delete($path);
            return "Image deleted successfully.";
        } catch (Exception $e) {
            Log::debug("Exception " . $e->getMessage());
            return "Failed to delete image.";
        }
    }
    public function uploadImage($file, $fileName, $folder="")
    {
        try {
            if (!Storage::disk('minio')->exists($folder)) {
                Storage::disk('minio')->makeDirectory($folder);
            }
            Storage::disk('minio')->putFileAs(
                $folder,
                $file,$fileName
            );
          return "http://localhost:9000/".$folder."/".$fileName;
        } catch (Exception $e) {
            Log::debug("Exeption ".$e->getMessage());
        }
    }

}
