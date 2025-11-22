@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Doctor: {{ $doctor->name }}</h1>

    <div class="mb-2"><strong>Specialty:</strong> {{ $doctor->specialty }}</div>
    <div class="mb-2"><strong>Phone:</strong> {{ $doctor->phone }}</div>

    <a href="{{ route('doctors.index') }}" class="mt-4 inline-block text-indigo-600">Back to list</a>
</div>
@endsection
