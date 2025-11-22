@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Patient</h1>

    <form action="{{ route('patients.update', $patient) }}" method="POST" class="space-y-4 max-w-md">
        @csrf
        @method('PUT')
        <div>
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ old('name', $patient->name) }}" class="w-full border px-2 py-1" required>
            @error('name')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block">Birth Date</label>
            <input type="date" name="birth_date" value="{{ old('birth_date', $patient->birth_date) }}" class="w-full border px-2 py-1">
        </div>
        <div>
            <label class="block">Phone</label>
            <input type="text" name="phone" value="{{ old('phone', $patient->phone) }}" class="w-full border px-2 py-1">
        </div>
        <div>
            <label class="block">Address</label>
            <textarea name="address" class="w-full border px-2 py-1">{{ old('address', $patient->address) }}</textarea>
        </div>
        <div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Update</button>
        </div>
    </form>
</div>
@endsection
