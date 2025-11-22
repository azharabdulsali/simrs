@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Appointments</h1>
        <a href="{{ route('appointments.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">New Appointment</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Patient</th>
                <th class="px-4 py-2">Doctor</th>
                <th class="px-4 py-2">Scheduled At</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $appointment->patient->name }}</td>
                <td class="px-4 py-2">{{ $appointment->doctor->name }}</td>
                <td class="px-4 py-2">{{ $appointment->scheduled_at }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('appointments.show', $appointment) }}" class="text-indigo-600">View</a>
                    <a href="{{ route('appointments.edit', $appointment) }}" class="ms-2 text-yellow-600">Edit</a>
                    <form action="{{ route('appointments.destroy', $appointment) }}" method="POST" class="inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $appointments->links() }}</div>
</div>
@endsection
