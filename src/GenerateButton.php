<?php

namespace Gridonic\AltTextGenerator;

use Statamic\Fields\Fieldtype;

class GenerateButton extends Fieldtype
{
    protected $icon = 'button_group';

    public function __construct()
    {
        $this->configFields = [
            'language' => [
                'display' => 'Language',
                'instructions' => 'Choose the language for the generated alt text.',
                'type'    => 'select',
                'default' => 'de',
                'options' => [
                    'de' => 'Deutsch',
                    'fr'   => 'Français',
                    'en'   => 'English',
                ],
                'width'   => 33
            ],
        ];
    }

    public function preload() {
        return [
            'language' => $this->config('language', 'de')
        ];
    }
}
