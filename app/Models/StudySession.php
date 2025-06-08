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
        'status',
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

    public static function statuses(): array
    {
        return [
            'planned' => 'Planejada',
            'in_progress' => 'Em Andamento',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'planned' => 'blue',
            'in_progress' => 'yellow',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }

    public function getFormattedStartTimeAttribute(): string
    {
        return $this->start_time->format('d/m/Y');
    }
} 