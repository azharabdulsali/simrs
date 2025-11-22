@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Appointment</h1>

    <div class="mb-2"><strong>Patient:</strong> {{ $appointment->patient->name }}</div>
    <div class="mb-2"><strong>Doctor:</strong> {{ $appointment->doctor->name }}</div>
    <div class="mb-2"><strong>Scheduled At:</strong> {{ $appointment->scheduled_at }}</div>
    <div class="mb-2"><strong>Notes:</strong> {{ $appointment->notes }}</div>

    <a href="{{ route('appointments.index') }}" class="mt-4 inline-block text-indigo-600">Back to list</a>
</div>
@endsection
