<?php

namespace App\Http\Controllers;

use App\Http\Resources\ActivityResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('view', new Activity());

        return Inertia::render('Activities/Index', [
            'activities' => ActivityResource::collection(Activity::all()),
        ]);
    }

    /**view
     * Show the form for creating a new resource.
     */
    public function show(Activity $activity)
    {
        Gate::authorize('show', $activity);

        return Inertia::render('Activities/Show', [
            'activity' => new ActivityResource($activity),
        ]);
    }
}
