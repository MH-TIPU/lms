<?php
namespace Cyaxaress\Media\Services;


use Cyaxaress\Media\Contracts\FileServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageFileService extends DefaultFileService implements FileServiceContract
{
    protected static $sizes = ['300', '600'];

    public static function upload(UploadedFile $file,$filename, $dir) :array
    {
        Storage::putFileAs( $dir , $file, $filename . '.' . $file->getClientOriginalExtension());
        $path = $dir . $filename .  '.' . $file->getClientOriginalExtension();
        return self::resize(Storage::path($path), $dir, $filename, $file->getClientOriginalExtension());
    }

    private static function resize($img, $dir, $filename, $extension)
    {
        $img = Image::make($img);
        $imgs['original'] =  $filename . '.' . $extension;
        foreach (self::$sizes as $size) {
            $imgs[$size] = $filename . '_'. $size. '.' . $extension;
            $img->resize($size, null, function ($aspect) {
                $aspect->aspectRatio();
            })->save(Storage::path($dir) . $filename . '_'. $size. '.' . $extension);
        }
        return $imgs;
    }
}
