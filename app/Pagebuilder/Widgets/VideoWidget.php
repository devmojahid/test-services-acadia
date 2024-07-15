<?php

namespace App\Pagebuilder\Widgets;

class VideoWidget extends BaseWidget
{

    protected static $name = 'video-widget';
    protected static $title = 'Video Widget';
    protected static $icon = 'icon-video';
    protected static $groupName = 'Media';
    protected static $controls = [
        'video' => [
            'type' => 'text',
            'label' => 'Video URL',
            'default' => 'https://www.youtube.com/watch?v=6v2L2UGZJAM'
        ]
    ];

    protected static $view = 'widgets.video';
    // public function render()
    // {
    //     return view('widgets.video')->render();
    // }

    // public static function getName()
    // {
    //     return 'Video Widget';
    // }

    // public static function getIcon()
    // {
    //     return 'icon-video';
    // }

    // public function editable()
    // {
    //     return true;
    // }

    // public static function getGroupName()
    // {
    //     return 'Media';
    // }
}
