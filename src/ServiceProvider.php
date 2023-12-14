<?php

namespace Gridonic\AltTextGenerator;

use Statamic\Events\AssetContainerBlueprintFound;
use Statamic\Providers\AddonServiceProvider;

class ServiceProvider extends AddonServiceProvider
{
    protected $fieldtypes = [
        AltTextGeneratorInputs::class
    ];

    protected $listen = [
        AssetContainerBlueprintFound::class => [
            BlueprintListener::class
        ]
    ];

    protected $vite = [
        'input' => [
            'resources/js/addon.js',
            'resources/css/addon.css',
        ],
        'publicDirectory' => 'resources/dist',
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
