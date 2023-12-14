<?php

namespace Gridonic\AltTextGenerator\Services;

class ImageDataService
{
    public function processImageUrl(string $url): string
    {
        $replacements = array(
            "/cp" => "",
            "/browse" => "",
            "_assets" => "",
            "/edit" => "",
        );
        $imageUrl = strtr($url, $replacements);

        return $imageUrl;
    }
}
