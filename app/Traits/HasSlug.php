<?php
namespace App\Traits;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug()
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = self::generateUniqueSlug($model, $model->getSlugSource());
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty($model->getSlugSource())) {
                $model->slug = self::generateUniqueSlug($model, $model->getSlugSource());
            }
        });
    }

    // Function to generate unique slug
    public static function generateUniqueSlug($model, $source)
    {
        $slug = Str::slug($source);
        $count = $model::where('slug', 'LIKE', "$slug%")->count();
        return $count ? "{$slug}-{$count}" : $slug;
    }

    // Function to determine the source field for slug generation
    public function getSlugSource()
    {
        return $this->title ?? $this->name ?? '';
    }
}

