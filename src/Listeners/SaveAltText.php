<?php

namespace Gridonic\AltTextGenerator\Listeners;

use Statamic\Events\AssetSaved;
use Symfony\Component\Yaml\Yaml;
use Gridonic\AltTextGenerator\Services\ImageDataService;
use Illuminate\Support\Facades\Cache;

class SaveAltText
{
    private ImageDataService $imageDataService;

    public function handle(AssetSaved $event)
    {
        $assetName = $event->asset['path'];
        $filePath = $this->getFilePath($assetName);
        $this->updateYamlData($filePath);

        Cache::flush();
    }

    public function getFilePath(string $assetName)
    {
        $assetDirectory = '../public/assets/main/';
        $path = $assetDirectory . $assetName;
        $pathArray = explode('/', $path);
        array_splice($pathArray, -1, 0, '.meta');
        return implode('/', $pathArray) . '.yaml';
    }

    public function updateYamlData(string $filePath)
    {
        $yaml = new Yaml();
        $yamlContent = $yaml->parseFile($filePath);

        if (!isset($yamlContent['data']) || !is_array($yamlContent['data'])) {
            $yamlContent['data'] = [];
        }

        if (isset($yamlContent['data']['button_de'])) {
            $altDe = $yamlContent['data']['button_de'];
            unset($yamlContent['data']['button_de']);
        } elseif (isset($yamlContent['data']['alt_de'])) {
            $altDe = $yamlContent['data']['alt_de'];
        } else {
            $altDe = '';
        }

        if (isset($yamlContent['data']['button_en'])) {
            $altEn = $yamlContent['data']['button_en'];
            unset($yamlContent['data']['button_en']);
        } elseif (isset($yamlContent['data']['alt_en'])) {
            $altEn = $yamlContent['data']['alt_en'];
        } else {
            $altEn = '';
        }

        if (isset($yamlContent['data']['button_fr'])) {
            $altFr = $yamlContent['data']['button_fr'];
            unset($yamlContent['data']['button_fr']);
        } elseif (isset($yamlContent['data']['alt_fr'])) {
            $altFr = $yamlContent['data']['alt_fr'];
        } else {
            $altFr = '';
        }

        $dataToAdd = [
            'alt_de' => $altDe,
            'alt_fr' => $altFr,
            'alt_en' => $altEn
        ];

        $yamlContent['data'] = array_merge($yamlContent['data'], $dataToAdd);

        file_put_contents($filePath, Yaml::dump($yamlContent, 4));
    }
}
