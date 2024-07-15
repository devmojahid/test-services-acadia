<?php

namespace App\Pagebuilder\Widgets;

class ImageWidget extends BaseWidget
{
    protected static $name = 'image-widget';
    protected static $title = 'Image Widget';
    protected static $icon = 'icon-image';
    protected static $groupName = 'Basic';
    protected static $controls = [
        'image' => [
            'type' => 'image',
            'label' => 'Image',
            'default' => 'https://via.placeholder.com/150'
        ]
    ];

    protected static $view = 'widgets.image';
    // public function render()
    // {
    //     return view('widgets.image')->render();
    // }

    // public static function getName()
    // {
    //     return 'Image Widget';
    // }

    // public static function getIcon()
    // {
    //     return 'icon-image';
    // }

    // public function editable()
    // {
    //     return true;
    // }

    // public static function getGroupName()
    // {
    //     return 'Basic';
    // }
}
