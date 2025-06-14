<?php

namespace App\Policies;

use App\Models\SelfAssessment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SelfAssessmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, SelfAssessment $selfAssessment): bool
    {
        return $selfAssessment->subject->user_id === $user->id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SelfAssessment $selfAssessment): bool
    {
        return $selfAssessment->subject->user_id === $user->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SelfAssessment $selfAssessment): bool
    {
        return $selfAssessment->subject->user_id === $user->id;
    }
}