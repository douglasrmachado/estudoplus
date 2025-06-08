<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Subject;
use App\Models\Task;
use App\Models\StudySession;
use App\Models\SelfAssessment;
use App\Policies\SubjectPolicy;
use App\Policies\TaskPolicy;
use App\Policies\StudySessionPolicy;
use App\Policies\SelfAssessmentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Subject::class => SubjectPolicy::class,
        Task::class => TaskPolicy::class,
        StudySession::class => StudySessionPolicy::class,
        SelfAssessment::class => SelfAssessmentPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
