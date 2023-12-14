<?php

namespace Gridonic\AltTextGenerator;

use Statamic\Events\AssetContainerBlueprintFound;

class BlueprintListener
{
    public function handle(AssetContainerBlueprintFound $event)
    {
        $fieldConfig = [
            'handle' => 'alt_text_generator_inputs',
            'field' => [
                'display' => 'Alt-Text Generator Inputs',
                'type' => 'alt_text_generator_inputs',
                'listable' => 'hidden',
                'visibility' => 'hidden'
            ],
        ];

        $event->blueprint->ensureField($fieldConfig['handle'], $fieldConfig['field']);
    }

}
