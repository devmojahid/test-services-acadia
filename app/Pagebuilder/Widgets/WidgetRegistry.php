<?php

namespace App\Pagebuilder\Widgets;

class WidgetRegistry
{
    protected static $widgets = [];

    public static function register($widget)
    {
        self::$widgets[$widget::getName()] = $widget;
    }

    public static function getWidgets()
    {
        return self::$widgets;
    }

    public static function getWidget($name)
    {
        return self::$widgets[$name];
    }
}
