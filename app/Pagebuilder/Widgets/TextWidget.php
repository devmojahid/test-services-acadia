<?php

namespace App\Pagebuilder\Widgets;

class TextWidget extends BaseWidget
{
    protected static $name = 'text-widget';
    protected static $title = 'Text Widget';
    protected static $icon = 'fa-brands fa-facebook-f';
    protected static $groupName = 'Basic';
    protected static $controls = [
        'text_type_controll' => [
            'type' => ControlTypes::TEXT,
            'label' => 'Text',
            'default' => 'Hello World'
        ],
        'text-description' => [
            'type' => ControlTypes::TEXTAREA,
            'label' => 'Description',
            'default' => 'This is a text widget'
        ],
        "text-image" => [
            "type" => ControlTypes::IMAGE,
            "label" => "Image",
            "default" => ""
        ],
    ];

    protected static $view = 'widgets.text';

    // public function render()
    // {
    //     return view('widgets.text')->render();
    // }

    // public static function getName()
    // {
    //     return 'Text Widget';
    // }

    // public static function getIcon()
    // {
    //     return 'fa-brands fa-facebook-f';
    // }

    // public function editable()
    // {
    //     return true;
    // }

    // public static function getGroupName()
    // {
    //     return 'Basic';
    // }

    // public static function getControls()
    // {
    //     return [
    //         'text' => [
    //             'type' => 'text',
    //             'label' => 'Text',
    //             'default' => 'Hello World'
    //         ]
    //     ];
    // }
}
