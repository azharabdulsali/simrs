<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $appointments = Appointment::with(['patient','doctor'])->latest()->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();
        return view('appointments.create', compact('patients','doctors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'scheduled_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        Appointment::create($data);

        return redirect()->route('appointments.index')->with('success', 'Appointment created');
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['patient','doctor']);
        return view('appointments.show', compact('appointment'));
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::orderBy('name')->get();
        $doctors = Doctor::orderBy('name')->get();
        return view('appointments.edit', compact('appointment','patients','doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $data = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'scheduled_at' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $appointment->update($data);

        return redirect()->route('appointments.index')->with('success', 'Appointment updated');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted');
    }
}
