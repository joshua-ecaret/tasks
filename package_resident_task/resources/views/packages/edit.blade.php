@extends('layouts.app')
@section('title', 'Edit Packages')

@section('header', 'Edit')

@section('content')
<x-package-form :package="$package" />

@endsection

@push('scripts')
@endpush