<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        'teacher',
        'color',
        'description',
        'user_id'
    ];

    /**
     * Get the user that owns the subject.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the study sessions for the subject.
     */
    public function studySessions()
    {
        return $this->hasMany(StudySession::class);
    }

    /**
     * Get the tasks for the subject.
     */
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    /**
     * Get the self assessments for the subject.
     */
    public function selfAssessments()
    {
        return $this->hasMany(SelfAssessment::class);
    }
}
