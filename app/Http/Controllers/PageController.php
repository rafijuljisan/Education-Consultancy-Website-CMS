<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use App\Models\AboutSection;

class PageController extends Controller
{
    public function contact()
    {
        return view('pages.contact', [
            'settings' => GeneralSetting::first(),
        ]);
    }

    public function about()
    {
        return view('pages.about', [
            'settings' => GeneralSetting::first(),
            'sections' => AboutSection::where('is_active', true)
                ->orderBy('sort_order')
                ->get(),
        ]);
    }
}