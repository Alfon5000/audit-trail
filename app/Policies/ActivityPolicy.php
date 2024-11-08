<?php

namespace App\Policies;

use App\Models\User;
use Spatie\Activitylog\Models\Activity;

class ActivityPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, Activity $activity): bool
    {
        return $user->hasPermissionTo('view activities');
    }

    public function show(User $user, Activity $activity): bool
    {
        return $user->hasPermissionTo('view activity');
    }
}
