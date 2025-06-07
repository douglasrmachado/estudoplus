<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'title',
        'description',
        'due_date',
        'priority',
        'status',
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public static function priorities(): array
    {
        return [
            'low' => 'Baixa',
            'medium' => 'Média',
            'high' => 'Alta',
        ];
    }

    public static function statuses(): array
    {
        return [
            'pending' => 'Pendente',
            'in_progress' => 'Em Andamento',
            'completed' => 'Concluída',
            'cancelled' => 'Cancelada',
        ];
    }

    public function getPriorityLabelAttribute(): string
    {
        return self::priorities()[$this->priority] ?? $this->priority;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function getPriorityColorAttribute(): string
    {
        return match($this->priority) {
            'low' => 'blue',
            'medium' => 'yellow',
            'high' => 'red',
            default => 'gray'
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'yellow',
            'in_progress' => 'blue',
            'completed' => 'green',
            'cancelled' => 'red',
            default => 'gray'
        };
    }
} 