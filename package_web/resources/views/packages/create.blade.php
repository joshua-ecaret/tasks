@extends('layouts.app')
@section('title', 'Create Packages')

@section('header', content: 'Create')

@section('content')
<x-form :package="$package" />

@endsection

@push('scripts')
@vite('resources/js/packages-form.js')
@endpush