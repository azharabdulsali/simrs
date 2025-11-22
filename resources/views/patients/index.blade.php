@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Patients</h1>
        <a href="{{ route('patients.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">New Patient</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Birth Date</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($patients as $patient)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $patient->name }}</td>
                <td class="px-4 py-2">{{ $patient->phone }}</td>
                <td class="px-4 py-2">{{ $patient->birth_date }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('patients.show', $patient) }}" class="text-indigo-600">View</a>
                    <a href="{{ route('patients.edit', $patient) }}" class="ms-2 text-yellow-600">Edit</a>
                    <form action="{{ route('patients.destroy', $patient) }}" method="POST" class="inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $patients->links() }}</div>
</div>
@endsection
