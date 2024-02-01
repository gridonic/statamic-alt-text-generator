<?php

namespace Gridonic\AltTextGenerator\Services;

class ImageDataService
{
    public function processImageUrl(string $url): string
    {
        $replacements = array(
            "https://boilerplate.gridonic.test/cp" => "",
            "/browse" => "",
            "_assets" => "",
            "/edit" => "",
        );
        $imagePath = $_SERVER['DOCUMENT_ROOT'] . strtr($url, $replacements);

        // Image gets converted to base64 string to circumvent browserlock on stage
        return $this->encodeImage($imagePath);
    }

    public function encodeImage(string $imagePath): string
    {
        $image = file_get_contents($imagePath);
        //Encode the image to base64 and remove the prefix to get raw data
        $imageData = base64_encode($image);
        return preg_replace('#^data:image/[^;]+;base64,#', '', $imageData);
    }
}
