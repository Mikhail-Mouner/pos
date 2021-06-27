<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = Activity::with('subject')->latest()->get();
        return view('dashboard.index',compact('activities'));
    }
}
