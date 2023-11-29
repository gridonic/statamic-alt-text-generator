<?php

namespace Gridonic\AltTextGenerator\Services;

use Illuminate\Http\JsonResponse;

class ImageDataService
{


    public function processImageUrl(string $url): string {
        $replacements = array(
            "/cp" => "",
            "/browse" => "",
            "_assets" => "",
            "/edit" => "",
        );
        $imageUrl = strtr($url, $replacements);

        return $imageUrl;

    }
    public function getFilePathFromUrl(string $url): string {
        $imageUrlArray = explode('main_assets', $url);
        $assetName = end($imageUrlArray);

        $filePath = $this->createFilePath($assetName);
        if (!$filePath) {
            return new JsonResponse(['error' => 'file path could not be found'], '401');
        }
        return $filePath;
    }

    public function createFilePath(string $assetName) {
        $assetDirectory = '../public/assets/main';
        $assetName = explode('/edit', $assetName);
        $assetName = reset($assetName). '.yaml';
        $path = $assetDirectory . $assetName;
        $pathArray = explode('/', $path);
        array_splice($pathArray, -1, 0, '.meta');
        $filePath = implode('/', $pathArray);
        return $filePath;
    }


}
