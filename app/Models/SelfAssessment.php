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
        'study_effectiveness',
        'confidence_level',
        'strengths',
        'areas_to_improve',
        'action_plan',
        'notes',
    ];

    protected $casts = [
        'assessment_date' => 'date',
    ];

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    public static function levels(): array
    {
        return [
            1 => 'Muito Baixo',
            2 => 'Baixo',
            3 => 'Médio',
            4 => 'Alto',
            5 => 'Muito Alto',
        ];
    }

    public function getLevelLabelAttribute(string $field): string
    {
        $value = $this->attributes[$field] ?? null;
        return self::levels()[$value] ?? 'Não Avaliado';
    }

    public function getLevelColorAttribute(string $field): string
    {
        $value = $this->attributes[$field] ?? null;
        return match($value) {
            1 => 'red',
            2 => 'orange',
            3 => 'yellow',
            4 => 'blue',
            5 => 'green',
            default => 'gray'
        };
    }

    public function getUnderstandingLevelLabelAttribute(): string
    {
        return $this->getLevelLabelAttribute('understanding_level');
    }

    public function getStudyEffectivenessLabelAttribute(): string
    {
        return $this->getLevelLabelAttribute('study_effectiveness');
    }

    public function getConfidenceLevelLabelAttribute(): string
    {
        return $this->getLevelLabelAttribute('confidence_level');
    }

    public function getUnderstandingLevelColorAttribute(): string
    {
        return $this->getLevelColorAttribute('understanding_level');
    }

    public function getStudyEffectivenessColorAttribute(): string
    {
        return $this->getLevelColorAttribute('study_effectiveness');
    }

    public function getConfidenceLevelColorAttribute(): string
    {
        return $this->getLevelColorAttribute('confidence_level');
    }
} 