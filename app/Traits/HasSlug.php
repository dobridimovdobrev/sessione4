<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = self::generateUniqueSlug($model, $model->title);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title')) {
                $model->slug = self::generateUniqueSlug($model, $model->title);
            }
        });
    }

    // Function to generate unique slug
    public static function generateUniqueSlug($model, $title)
    {
        $slug = Str::slug($title);
        $count = $model::where('slug', 'LIKE', "$slug%")->count(); // Using $model instead of static
        return $count ? "{$slug}-{$count}" : $slug;
    }
}
