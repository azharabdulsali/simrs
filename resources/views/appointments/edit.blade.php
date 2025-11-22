@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Appointment</h1>

    <form action="{{ route('appointments.update', $appointment) }}" method="POST" class="space-y-4 max-w-md">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Patient</label>
            <select name="patient_id" class="w-full border px-2 py-1" required>
                <option value="">-- select patient --</option>
                @foreach($patients as $p)
                    <option value="{{ $p->id }}" {{ old('patient_id', $appointment->patient_id) == $p->id ? 'selected' : '' }}>{{ $p->name }}</option>
                @endforeach
            </select>
            @error('patient_id')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block">Doctor</label>
            <select name="doctor_id" class="w-full border px-2 py-1" required>
                <option value="">-- select doctor --</option>
                @foreach($doctors as $d)
                    <option value="{{ $d->id }}" {{ old('doctor_id', $appointment->doctor_id) == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
                @endforeach
            </select>
            @error('doctor_id')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block">Scheduled At</label>
            <input type="datetime-local" name="scheduled_at" value="{{ old('scheduled_at', $appointment->scheduled_at->format('Y-m-d\\TH:i')) }}" class="w-full border px-2 py-1" required>
            @error('scheduled_at')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>

        <div>
            <label class="block">Notes</label>
            <textarea name="notes" class="w-full border px-2 py-1">{{ old('notes', $appointment->notes) }}</textarea>
        </div>

        <div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
        </div>
    </form>
</div>
@endsection
