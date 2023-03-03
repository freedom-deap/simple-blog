<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\File;

class ImageService
{
    // public static function checkUploadedFile()
    // {
        
    // }
    
    public static function deleteImage($request, $targetEntry)
    {
        $deleteImgPath = $request->get('img_path');
        Storage::disk('public')->delete($deleteImgPath);
        $targetEntry->img_path = null;
    }
    
    public static function saveImage($uploadFile, $targetEntry)
    {
        $filePath = self::imageResize($uploadFile);
        $targetEntry->img_path = $filePath;
    }
    
    public static function imageResize($imageObj)
    {
        $tmpImagePath = $imageObj->store('public/images/tmp');
        $tmpStoragePath = str_replace('public/', 'storage/', $tmpImagePath);
        $tmpImg = Image::make($tmpStoragePath);
        
        list($height, $width) = array($tmpImg->height(), $tmpImg->width());
        $resizePercent = $height > $width ? 1000/$height : 1000/$width;

        $tmpImg->resize($width*$resizePercent, $height*$resizePercent);
        $resizeImgPath = str_replace('tmp', 'blog_entry', $tmpStoragePath);
        $tmpImg->save($resizeImgPath, 80, 'jpg');
        
        unlink($tmpStoragePath);

        $replaceTarget = array('public', 'tmp');
        $replaceResult = array('', 'blog_entry');
        
        return str_replace($replaceTarget, $replaceResult, $tmpImagePath);
    }
    
    public static function imgOperation($request, $targetEntry)
    {
        if($request->has('add-btn'))
        {
            $uploadFile = $request->file('img_file');
            if(is_null($uploadFile)){
                return;
            }
            self::saveImage($uploadFile, $targetEntry);
        }
        elseif($request->has('update-btn'))
        {
            $uploadFile = $request->file('img_file');
            if(is_null($uploadFile)){
                return;
            }
            self::saveImage($uploadFile, $targetEntry);
            self::deleteImage($request, $targetEntry);
        }
        elseif($request->has('delete-btn'))
        {
            self::deleteImage($request, $targetEntry);
        }
        else
        {
            return;
        }
        return;
    }
}