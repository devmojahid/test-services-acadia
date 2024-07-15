<?php

namespace App\Pagebuilder\Widgets;

interface WidgetInterface
{
    public static function render(): string;
    public static function getName(): string;
    public static function getTitle(): string;
    public static function getIcon(): string;
    public static function getGroupName(): string;
    public static function getControls(): array;
}
