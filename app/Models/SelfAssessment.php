<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SelfAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'assessment_date',
        'understanding_level',
        'confidence_level',
        'action_plan',
    ];

    protected $casts = [
        'assessment_date' => 'datetime',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public function getUnderstandingLevelLabelAttribute(): string
    {
        return match($this->understanding_level) {
            1 => 'Muito Baixo',
            2 => 'Baixo',
            3 => 'Médio',
            4 => 'Alto',
            5 => 'Muito Alto',
            default => 'Não Avaliado'
        };
    }

    public function getConfidenceLevelLabelAttribute(): string
    {
        return match($this->confidence_level) {
            1 => 'Muito Baixa',
            2 => 'Baixa',
            3 => 'Média',
            4 => 'Alta',
            5 => 'Muito Alta',
            default => 'Não Avaliada'
        };
    }

    public function getLevelColorAttribute($level): string
    {
        $value = $this->$level;
        return match($value) {
            1 => 'red',
            2 => 'orange',
            3 => 'indigo',
            4 => 'blue',
            5 => 'green',
            default => 'gray'
        };
    }
} 