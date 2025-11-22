@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">New Doctor</h1>

    <form action="{{ route('doctors.store') }}" method="POST" class="space-y-4 max-w-md">
        @csrf
        <div>
            <label class="block">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full border px-2 py-1" required>
            @error('name')<div class="text-red-600">{{ $message }}</div>@enderror
        </div>
        <div>
            <label class="block">Specialty</label>
            <input type="text" name="specialty" value="{{ old('specialty') }}" class="w-full border px-2 py-1">
        </div>
        <div>
            <label class="block">Phone</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border px-2 py-1">
        </div>
        <div>
            <button class="px-4 py-2 bg-indigo-600 text-white rounded">Save</button>
        </div>
    </form>
</div>
@endsection
