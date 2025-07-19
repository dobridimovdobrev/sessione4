<?php

namespace App\Helpers;

class ImageHelper
{
    private static $sizeMaps = [
        'poster' => ['w92', 'w154', 'w185', 'w342', 'w500', 'w780', 'original'],
        'backdrop' => ['w300', 'w780', 'w1280', 'original'],
        'persons' => ['w45', 'w185', 'h632', 'original'],
        'still' => ['w92', 'w185', 'w300', 'original']
    ];

    /**
     * Get the full URL for an image with optional size
     */
    public static function getImageUrl($imageFile, $size = null)
    {
        if (!$imageFile) {
            return null;
        }

        $sizePath = $size && in_array($size, self::$sizeMaps[$imageFile->type])
            ? $size
            : $imageFile->size_path;

        return $imageFile->base_path . $sizePath . '/' . $imageFile->url;
    }

    /**
     * Get available sizes for a specific image type
     */
    public static function getAvailableSizes($type)
    {
        return self::$sizeMaps[$type] ?? ['original'];
    }

    /**
     * Validate size for a specific image type
     */
    public static function isValidSize($type, $size)
    {
        return in_array($size, self::$sizeMaps[$type] ?? ['original']);
    }
}
