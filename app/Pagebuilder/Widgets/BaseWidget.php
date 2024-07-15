<?php

namespace App\Pagebuilder\Widgets;

abstract class BaseWidget implements WidgetInterface
{
    public static function getName(): string
    {
        return static::$name;
    }

    public static function getTitle(): string
    {
        return static::$title;
    }

    public static function getIcon(): string
    {
        return static::$icon;
    }

    public static function getGroupName(): string
    {
        return static::$groupName;
    }

    public static function getControls(): array
    {
        return static::$controls;
    }

    // public static function renderControls(array $data): string
    // {
    //     $controls = static::getControls();
    //     $html = '';

    //     foreach ($controls as $key => $control) {
    //         $value = $data[$key] ?? $control['default'];
    //         $html .= view('widgets.controls.' . $control['type'], [
    //             'key' => $key,
    //             'label' => $control['label'],
    //             'value' => $value
    //         ])->render();
    //     }

    //     return $html;
    // }

    public static function render(array $data = []): string
    {
        return view(static::$view, compact('data'))->render();
    }

    public function editable()
    {
        return true;
    }
}
