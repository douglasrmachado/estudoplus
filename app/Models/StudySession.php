<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudySession extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'start_time',
        'duration',
        'description',
        'status'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'duration' => 'integer',
    ];

    /**
     * Get the subject that owns the study session.
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
} 