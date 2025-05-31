@extends('layouts.app')
@section('title', 'Edit Resident')

@section('header', 'Edit')

@section('content')
<x-resident-form :resident="$resident" :packages="$packages" />

@endsection

@push('scripts')
@endpush