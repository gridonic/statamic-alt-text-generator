<?php

namespace Gridonic\AltTextGenerator\Services;

use Exception;
use Gridonic\AltTextGenerator\Constants\AltTextAiApi;
use GuzzleHttp\Client;

class AltTextAiApiRequestService
{
    public function sendRequest(string $imageUrl, string $textLanguage)
    {
        $apiEndpoint = AltTextAiApi::API_ENDPOINT;
        $client = new Client();

        $headers = [
            'Content-Type' => 'application/json',
            'X-API-Key' => env('ALTTEXT_AI_API_KEY')
        ];

        $data = [
            'lang' => $textLanguage,
            'image' => [
                'url' => $imageUrl
            ]
        ];

        try {
            $response = $client->request('POST', $apiEndpoint, [
                'headers' => $headers,
                'body' => json_encode($data)
            ]);

            $responseData = json_decode($response->getBody());
            $altText = $responseData['alt_text'];
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $altText;
    }
}
