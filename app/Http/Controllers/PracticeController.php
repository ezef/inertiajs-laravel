<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Practice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class PracticeController extends Controller
{
    public function show(Patient $patient, Practice $practice)
    {
        return Inertia::render('Practice/Show', compact('practice', 'patient'));
    }

    public function update(Request $request, Patient $patient, Practice $practice)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'duration' => 'required|integer',
            'date' => 'required|date',
        ]);

        $practice->update($validated);

        return Redirect::route('practice.show', ['practice' => $practice->id, 'patient' => $patient->id]);
    }
}

