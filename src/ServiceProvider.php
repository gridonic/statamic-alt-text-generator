<?php

namespace Gridonic\AltTextGenerator;

use Gridonic\AltTextGenerator\Listeners\SaveAltText;
use Gridonic\AltTextGenerator\Listeners\SetAltTextForAsset;
use Statamic\Events\AssetContainerSaved;
use Statamic\Events\AssetSaved;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        GenerateButton::class
    ];

    protected $listen = [
      AssetSaved::class => [
          SaveAltText::class
      ],
      AssetContainerSaved::class => [
          SaveAltText::class
      ]
    ];

    protected $scripts = [
        __DIR__.'/../dist/alt-text-generator.js'
    ];

    public function bootAddon()
    {
        $this->loadRoutes();
    }

    protected function loadRoutes(): self
    {
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        return $this;
    }
}
