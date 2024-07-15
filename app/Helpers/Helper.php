<?php

use App\Supports\FileUploadService;

if (!function_exists('upload_file')) {
    function upload_file($file, $directory, $disk = 'uploads', $fileable = null, $collection = 'default')
    {
        return app(FileUploadService::class)->uploadFile($file, $directory, $fileable, $collection);
    }
}

if (!function_exists('get_file_url')) {
    function get_file_url($filePath, $disk = 'uploads')
    {
        return app(FileUploadService::class)->getFileUrl($filePath, $disk);
    }
}

if (!function_exists('delete_file')) {
    function delete_file($filePath, $disk = 'uploads')
    {
        return app(FileUploadService::class)->deleteFile($filePath, $disk);
    }
}
