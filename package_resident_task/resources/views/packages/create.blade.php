@extends('layouts.app')
@section('title', 'Create Packages')

@section('header', content: 'Create')

@section('content')
<a href="{{ url()->previous() }}" class="btn btn-secondary">
    ← Back
</a>

<x-package-form :package="$package" />

@endsection

@push('scripts')
{{-- @vite('resources/js/packages-form.js') --}}
@endpush