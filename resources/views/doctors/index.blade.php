@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Doctors</h1>
        <a href="{{ route('doctors.create') }}" class="px-4 py-2 bg-indigo-600 text-white rounded">New Doctor</a>
    </div>

    @if(session('success'))
        <div class="mb-4 text-green-600">{{ session('success') }}</div>
    @endif

    <table class="min-w-full bg-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Specialty</th>
                <th class="px-4 py-2">Phone</th>
                <th class="px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($doctors as $doctor)
            <tr class="border-t">
                <td class="px-4 py-2">{{ $doctor->name }}</td>
                <td class="px-4 py-2">{{ $doctor->specialty }}</td>
                <td class="px-4 py-2">{{ $doctor->phone }}</td>
                <td class="px-4 py-2">
                    <a href="{{ route('doctors.show', $doctor) }}" class="text-indigo-600">View</a>
                    <a href="{{ route('doctors.edit', $doctor) }}" class="ms-2 text-yellow-600">Edit</a>
                    <form action="{{ route('doctors.destroy', $doctor) }}" method="POST" class="inline ms-2">
                        @csrf
                        @method('DELETE')
                        <button class="text-red-600" onclick="return confirm('Delete?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">{{ $doctors->links() }}</div>
</div>
@endsection
