<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Mpdf\Mpdf;
use Illuminate\Support\Carbon;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\Facades\View;
use InvalidArgumentException;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Container\ContainerExceptionInterface;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use App\Models\Application;


/**


 * Helper Class for handling ID CARD generation operations.
 *
 * @package App\Helpers
 *
 * @version 1.0.0
 * @author Sreeja
 */
class FileHelper
{
    /**
     * Get the base64 encoded string for the image from the file path.
     *
     * @param string $img_path Image file path.
     * @param bool $is_storage Whether the file from the storage directory or not.
     * @param array $placeholder_attr Placeholder image attributes.
     * @param bool $cache Whether to cache the data URI or not.
     *
     * @return string
     *
     * @version 1.0.0
     * @author Anantajit JG
     */
    public static function embedImage($img_path, $is_storage = true, $placeholder_attr = [], $cache = false)
    {
        // info($img_path);
        // If caching is enabled, generate a cache key and try to retrieve the data URI from the cache.
        if ($cache) {
            $cacheKey = 'embed_image_' . ($is_storage ? 'storage_' : 'file_') . md5($img_path);
            return Cache::remember($cacheKey, now()->addMinutes(180), function () use ($img_path, $is_storage, $placeholder_attr) {
                // Call the same function without caching to avoid recursion.
                return self::embedImage($img_path, $is_storage, $placeholder_attr, false);
            });
        }

        $placeholder_attr = array_merge([
            'width' => 150,
            'height' => 150,
        ], $placeholder_attr);

        if ($is_storage) {
            if (empty($img_path)) {
                return self::generatePlaceholderDataUri($placeholder_attr['width'], $placeholder_attr['height']);
            }
            $img_file = Storage::get($img_path);
            if (empty($img_file)) {
                $img_file = Storage::disk('public')->get($img_path);
                if (empty($img_file)) {
                    return self::generatePlaceholderDataUri($placeholder_attr['width'], $placeholder_attr['height']);
                }
            }
        } else {
            if (empty($img_path)) {
                return self::generatePlaceholderDataUri($placeholder_attr['width'], $placeholder_attr['height']);
            }
            $img_file = File::get($img_path);
        }
        $fileinfo = new \finfo(FILEINFO_MIME_TYPE);
        $mime_type = $fileinfo->buffer($img_file);
        $encoded = base64_encode($img_file);
        $image = "data:{$mime_type};base64,{$encoded}";
        return $image;
    }
    public static function generatePlaceholderDataUri($width = 150, $height = 150, $bgColor = [240, 240, 240], $borderColor = [230, 230, 230])
    {
        // Create a unique cache key based on parameters.
        $cacheKey = 'placeholder_' . $width . 'x' . $height . '_' . implode('-', $bgColor) . '_' . implode('-', $borderColor);
        // Check if the placeholder is already cached.
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Create a new true color image.
        $im = imagecreatetruecolor($width, $height);
        // Allocate background color and fill the image.
        $bg = imagecolorallocate($im, $bgColor[0], $bgColor[1], $bgColor[2]);
        imagefilledrectangle($im, 0, 0, $width, $height, $bg);
        // Allocate border color and draw a border.
        $border = imagecolorallocate($im, $borderColor[0], $borderColor[1], $borderColor[2]);
        imagerectangle($im, 0, 0, $width - 1, $height - 1, $border);
        // Capture the image output as PNG.
        ob_start();
        imagepng($im);
        $imageData = ob_get_clean();
        // Clean up memory.
        imagedestroy($im);
        // Build the data URI string.
        $encoded = base64_encode($imageData);
        $dataUri = "data:image/png;base64,{$encoded}";
        Cache::put($cacheKey, $dataUri, now()->addDay());

        return $dataUri;
    }


    public static function getCoverLetter($cover_letter_id)
    {
        $application_details = Application::with('countryRelation')->find($cover_letter_id);
      
        return view('download.application-pdf', [
            'application_details' => $application_details,
           
        ])->render();
    }



    public static function generateApplicationPDF($cover_letter_id)
    {
        $application_details = Application::with('countryRelation')->find($cover_letter_id);
        $application_content = self::getCoverLetter($cover_letter_id);

      $file_name= $application_details->application_no.'pdf';

        $mpdf = new Mpdf([
            'mode' => 'utf-8',
        ]);
        $mpdf->WriteHTML($application_content);
        $mpdf->Output($file_name, \Mpdf\Output\Destination::INLINE);
    }
}
