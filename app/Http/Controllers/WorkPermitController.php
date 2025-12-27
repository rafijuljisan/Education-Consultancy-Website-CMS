<?php

namespace App\Http\Controllers;

use App\Models\WorkPermit;
use Illuminate\Http\Request;

class WorkPermitController extends Controller
{
    public function show($slug)
    {
        $permit = WorkPermit::where('slug', $slug)
                    ->where('is_active', true)
                    ->firstOrFail();

        // Optional: Get other permits for sidebar
        $others = WorkPermit::where('id', '!=', $permit->id)
                    ->where('is_active', true)
                    ->take(5)
                    ->get();

        return view('work-permits.show', compact('permit', 'others'));
    }
}