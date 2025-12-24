<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\GeneralSetting;

class CountryController extends Controller
{
    // 1. Show all countries
    public function index()
    {
        return view('countries.index', [
            'settings' => GeneralSetting::first(),
            'countries' => Country::all(),
        ]);
    }

    // 2. Show a single country and its universities
    public function show($slug)
    {
        $country = Country::where('slug', $slug)
            ->with('universities') // Load universities for this country
            ->firstOrFail();

        return view('countries.show', [
            'settings' => GeneralSetting::first(),
            'country' => $country,
        ]);
    }
}