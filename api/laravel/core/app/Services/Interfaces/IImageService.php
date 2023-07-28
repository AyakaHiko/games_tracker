<?php

namespace App\Services\Interfaces;

interface IImageService
{
    public function uploadImage($file, $fileName, $folder="");
}
