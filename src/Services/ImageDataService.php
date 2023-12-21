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

        $rawData = $this->encodeImage($imagePath);
        return $rawData;
    }

    public function encodeImage(string $imagePath): string
    {
        $image = file_get_contents($imagePath);
        $rawData = base64_encode($image);

        return $rawData;
    }
}
