<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Os atributos que são atribuíveis em massa.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code',
        'description',
        'professor',
        'semester',
        'workload',
        'user_id',
        'status',
        'color'
    ];

    /**
     * Get the user that owns the subject.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the study sessions for the subject.
     */
    public function studySessions(): HasMany
    {
        return $this->hasMany(StudySession::class);
    }

    /**
     * Get the tasks for the subject.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the self assessments for the subject.
     */
    public function selfAssessments(): HasMany
    {
        return $this->hasMany(SelfAssessment::class);
    }

    /**
     * Formata automaticamente o semestre para incluir o ponto
     */
    public function setSemesterAttribute($value)
    {
        if (!empty($value)) {
            // Remove qualquer ponto existente primeiro
            $value = str_replace('.', '', $value);
            
            // Se o valor tiver 5 caracteres (ex: 20242), insere o ponto na posição correta
            if (strlen($value) == 5) {
                $value = substr_replace($value, '.', 4, 0);
            }
        }
        
        $this->attributes['semester'] = $value;
    }

    public static function statuses(): array
    {
        return [
            'active' => 'Ativa',
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
            'active' => 'green',
            'completed' => 'blue',
            'cancelled' => 'red',
            default => 'gray'
        };
    }
}
