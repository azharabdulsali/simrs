@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold mb-4">Patient: {{ $patient->name }}</h1>

    <div class="mb-2"><strong>Birth date:</strong> {{ $patient->birth_date }}</div>
    <div class="mb-2"><strong>Phone:</strong> {{ $patient->phone }}</div>
    <div class="mb-2"><strong>Address:</strong> {{ $patient->address }}</div>

    <a href="{{ route('patients.index') }}" class="mt-4 inline-block text-indigo-600">Back to list</a>
</div>
@endsection
