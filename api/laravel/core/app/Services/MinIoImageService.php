<?php

namespace App\Services;


use app\Services\Interfaces\IImageService;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MinIoImageService implements IImageService
{
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
