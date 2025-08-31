<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadProgress extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'upload_id',
        'file_name',
        'file_size',
        'uploaded_size',
        'progress_percentage',
        'status',
        'user_id',
        'file_type',
        'completed_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'progress_percentage' => 'float',
        'completed_at' => 'datetime',
    ];

    /**
     * Get the user that owns the upload progress.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Scope a query to only include active uploads.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'in_progress');
    }

    /**
     * Scope a query to only include completed uploads.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    /**
     * Update the progress of the upload.
     *
     * @param int $uploadedSize
     * @return bool
     */
    public function updateProgress($uploadedSize)
    {
        $this->uploaded_size = $uploadedSize;
        
        if ($this->file_size > 0) {
            $this->progress_percentage = min(100, ($uploadedSize / $this->file_size) * 100);
        }

        if ($this->progress_percentage >= 100) {
            $this->status = 'completed';
            $this->completed_at = now();
        }

        return $this->save();
    }

    /**
     * Mark the upload as completed.
     *
     * @return bool
     */
    public function markAsCompleted()
    {
        $this->status = 'completed';
        $this->progress_percentage = 100;
        $this->completed_at = now();
        
        return $this->save();
    }

    /**
     * Mark the upload as failed.
     *
     * @param string|null $errorMessage
     * @return bool
     */
    public function markAsFailed($errorMessage = null)
    {
        $this->status = 'failed';
        $this->error_message = $errorMessage;
        
        return $this->save();
    }
}
