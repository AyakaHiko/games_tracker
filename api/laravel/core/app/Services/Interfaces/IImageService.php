<?php

namespace app\Services\Interfaces;

interface IImageService
{
    public function uploadImage($file, $fileName, $folder="");
}
