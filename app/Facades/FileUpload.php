<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class FileUpload extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'file-upload';
    }
}
