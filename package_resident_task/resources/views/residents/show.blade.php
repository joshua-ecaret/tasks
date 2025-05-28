@extends('layouts.app')

@section('content')
    <div class="conatianer m-5">
        <div class="card">
            <div class="card-header">Resident Details</div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $resident->resident_name }}</p>
                <p><strong>Email:</strong> {{ $resident->email }}</p>
                <p><strong>Phone:</strong> {{ $resident->phone }}</p>
                <p><strong>Status:</strong> {{ $resident->status->value }}</p>
                <p><strong>Package:</strong> {{ $resident->package->package_name }}</p>
            </div>
        </div>
    </div>
@endsection