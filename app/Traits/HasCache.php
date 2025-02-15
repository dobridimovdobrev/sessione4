<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait HasCache
{
    /**
     * Get cached model by ID
     */
    public static function getCached($id)
    {
        $class = get_called_class();
        $key = strtolower(class_basename($class)) . "_{$id}";
        
        return Cache::remember($key, now()->addHours(24), function () use ($id) {
            return static::find($id);
        });
    }

    /**
     * Clear model cache
     */
    public function clearCache()
    {
        $key = strtolower(class_basename($this)) . "_{$this->getKey()}";
        Cache::forget($key);
    }

    /**
     * Boot the trait
     */
    protected static function bootHasCache()
    {
        static::updated(function ($model) {
            $model->clearCache();
        });

        static::deleted(function ($model) {
            $model->clearCache();
        });
    }
}
