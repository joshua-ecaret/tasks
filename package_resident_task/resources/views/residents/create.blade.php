@extends('layouts.app')
@section('title', 'Create Resident')

@section('header', content: 'Create')

@section('content')
<x-resident-form :resident="null" />

@endsection

@push('scripts')
    @vite('resources/js/resident-form.js')
@endpush