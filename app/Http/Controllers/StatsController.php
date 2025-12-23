<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StatsController extends Controller
{
public function index()
{
    return response()->json([
        'faculties' => \App\Models\Faculty::count(),
        'departments' => \App\Models\Department::count(),
        'staff' => \App\Models\Staff::count(),
        'buildings' => \App\Models\Building::count(),
    ]);
}
}
