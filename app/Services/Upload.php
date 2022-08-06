<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;

class Upload
{
    public static function save($file, $disk)
    {
        return  $file->store($disk);
    }

    public static function update($file, $disk, $path)
    {
        static::delete($path)->save($file, $disk);
    }

    public static function delete($path)
    {

        $filename = public_path($path);

        if (File::exists($filename)) {

            File::delete($filename);
        }

        return new self;
    }
}
