<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\GeneralSetting;

class ServiceController extends Controller
{
    // Show list of all services
    public function index()
    {
        return view('services.index', [
            'settings' => GeneralSetting::first(),
            'services' => Service::where('is_active', true)->get(),
        ]);
    }

    // Show a single service detail page
    public function show($slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('services.show', [
            'settings' => GeneralSetting::first(),
            'service' => $service,
            // Pass other services for the sidebar list
            'other_services' => Service::where('id', '!=', $service->id)->where('is_active', true)->get(),
        ]);
    }
}