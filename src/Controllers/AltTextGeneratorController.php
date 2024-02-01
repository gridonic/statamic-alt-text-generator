<?php

namespace Gridonic\AltTextGenerator\Controllers;

use Gridonic\AltTextGenerator\Services\AltTextAiApiRequestService;
use Gridonic\AltTextGenerator\Services\ImageDataService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Statamic\Http\Controllers\Controller;

class AltTextGeneratorController extends Controller
{
    public function submitData(Request $request)
    {
        if (!$request->json('imageUrl')) {
            return new JsonResponse(['error' => 'image url not set.'], '401');
        } else {
            $url = $request->json('imageUrl');
        }

        if (!$request->json('textLanguage')) {
            return new JsonResponse(['error' => 'textLanguage not set.'], '401');
        } else {
            $textLanguage = $request->json('textLanguage');
        }

        $altText = $this->generateAltText($url, $textLanguage);

        $responseData = [
            'altText' => $altText,
        ];

        echo json_encode($responseData);
    }

    // Process image data and send request to AltText.ai API
    public function generateAltText(string $url, string $textLanguage)
    {
        $imageDataService = new ImageDataService();
        $altTextAiApiRequestService = new AltTextAiApiRequestService();

        $rawData = $imageDataService->processImageUrl($url);
        if (!$rawData) {
            return new JsonResponse(['error' => 'Image raw data could not be created'], '401');
        }

        $altText = $altTextAiApiRequestService->sendRequest($rawData, $textLanguage);

        if (!$altText) {
            return new JsonResponse(['error' => 'alt text could not be generated'], '401');
        }
        return $altText;
    }
}
