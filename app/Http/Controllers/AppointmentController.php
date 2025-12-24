<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function store(Request $request)
    {
        // 1. Validate
        $validated = $request->validate([
            'subject' => 'required|string',
            'country' => 'required|string',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string',
            'ielts_score' => 'nullable|string',
            'message' => 'nullable|string',
        ]);

        // 2. Create
        Appointment::create($validated);

        // 3. Redirect back with success message
        return back()->with('success', 'Appointment request submitted successfully! We will contact you soon.');
    }
}