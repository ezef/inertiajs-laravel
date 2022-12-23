<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::all();
        return Inertia::render('Patient/Index', compact('patients'));
    }

    public function show(Patient $patient): Response
    {
        return Inertia::render('Patient/Show', compact('patient'));
    }

    public function update(Request $request, Patient $patient)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'age' => 'required|integer',
            'blood_type' => 'required|string',
        ]);

        $patient->update($validated);

        return Redirect::route('patient.show', $patient->id);
    }
}
