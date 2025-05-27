@extends('layouts.app')
@section('title', 'Edit Packages')

@section('header', 'Edit')

@section('content')
<x-form :package="$package" />

@endsection

@push('scripts')
@vite('resources/js/packages-form.js')
@endpush