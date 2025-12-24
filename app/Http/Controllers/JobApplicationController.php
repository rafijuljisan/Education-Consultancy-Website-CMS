<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobApplication;

class JobApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'career_id' => 'required|exists:careers,id',
            'name' => 'required|string',
            'email' => 'required|email',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048', // Max 2MB
        ]);

        $path = $request->file('resume')->store('resumes', 'public');

        JobApplication::create([
            'career_id' => $request->career_id,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume_path' => $path,
        ]);

        return back()->with('success', 'Application submitted successfully!');
    }
}