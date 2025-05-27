@extends('layouts.app')
@section('title', 'Edit Resident')

@section('header', 'Edit')

@section('content')
<x-resident-form :resident="$resident" />

@endsection

@push('scripts')
@endpush