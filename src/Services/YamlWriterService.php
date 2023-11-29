<?php

namespace Gridonic\AltTextGenerator\Services;

use Illuminate\Http\JsonResponse;
use Symfony\Component\Yaml\Yaml;

class YamlWriterService
{
    public function addDataToYaml(string $altText, string $textLanguage, string $filePath) {
        $dataToAdd = [
            'alt_'.$textLanguage => $altText
        ];


        $this->insertIntoFile($filePath, $dataToAdd);
    }

    public function insertIntoFile(string $filePath, array $dataToAdd) {
            $yamlData = Yaml::parseFile($filePath);

            if (!isset($yamlData['data']) || !is_array($yamlData['data'])) {
                $yamlData['data'] = [];
            }

            $yamlData['data'] = array_merge($yamlData['data'], $dataToAdd);

            file_put_contents($filePath, Yaml::dump($yamlData, 4));
        }

}
