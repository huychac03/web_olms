<?php
 namespace App\Helpers;
 use Intervention\Image\Facades\Image;
 use Illuminate\Support\Facades\File;
 use Carbon\Carbon;

 class HelpersFun
 {
     /**
      * Create directory if it don't exist
      *
      * @param string $path
      *
      * @return bool
      */
     public static function checkAndMakeDirectory($path)
     {
         $realPath = public_path($path);
         if (!File::exists($realPath)) {
             return File::makeDirectory($realPath, 0775, true);
         }
         return true;
     }
     /**
      * Resize and Save image
      *
      * @param $image
      * @param string $directory
      * @param array $size
      *
      * @return string
      */
     public static function saveImage($image, $directory = '', $size = ['width' => 800, 'height' => 600])
     {
         try {
             $directory = str_replace('.', DIRECTORY_SEPARATOR, $directory);
             $imageRealPath = $image->getRealPath();
             $timestamp = Carbon::now()->format('Y-m-d-H-i-s');
             $fileName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
             $extension = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
             $thumbName = $timestamp . '-' . str_slug($fileName, "-") .'-'.$size['width'].'-'.$size['height'].'.'. $extension;

             $img = Image::make($imageRealPath);
             if ($img->width() > $size['width']) {
                 $img->resize(intval($size['width']), null, function ($constraint) {
                     $constraint->aspectRatio();
                 });
             } elseif ($img->height() > $size['height']) {
                 $img->resize(null, intval($size['height']), function ($constraint) {
                     $constraint->aspectRatio();
                 });
             }
             $pathToDirectory = DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . $directory . DIRECTORY_SEPARATOR;
             if (!self::checkAndMakeDirectory($pathToDirectory)) {
                 throw new FileException(sprintf('Không thể tạo thư mục "%s" ', $pathToDirectory));
             }

             $path = $pathToDirectory . $thumbName;
             $img->save(public_path() . $path);

             return $path;
         } catch (Exception $e) {
             return false;
         }
     }

     /**
      * @param $image
      * @return string
      */
     public static function getNameImage($image, $directory = '')
     {
         $nameimg  = $image->getClientOriginalName();
         $type = $image->getClientOriginalExtension();
         $timestamp = Carbon::now()->format('Y-m-d-H-i-s');
         $nameimg = $timestamp . '_'. md5($nameimg) . '.'. $type;
         $image->move(public_path() . '/uploads/'. $directory, $nameimg);
         
         return $nameimg;
     }

     /**
      * Delete image by path
      *
      * @param string $path
      *
      * @return mixed
      */
     public static function deleteImage($path)
     {
         $realPath = public_path($path);
         if (File::exists($realPath)) {
             return File::delete($realPath);
         }
         return true;
     }
 }