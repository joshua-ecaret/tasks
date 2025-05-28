@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row g-4">
        <!-- Residents Card -->
        <div class="col-md-6">
            <div class="card bg-dark text-white h-100 shadow-lg border-0 transition" style="cursor: pointer;" onclick="window.location.href='{{ route('residents.index') }}'">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h5 class="card-title mb-3">Residents</h5>
                    <p class="card-text text-secondary">Manage all residents in the system.</p>
                </div>
            </div>
        </div>

        <!-- Packages Card -->
        <div class="col-md-6">
            <div class="card bg-dark text-white h-100 shadow-lg border-0 transition" style="cursor: pointer;" onclick="window.location.href='{{ route('packages.index') }}'">
                <div class="card-body d-flex flex-column justify-content-center text-center">
                    <h5 class="card-title mb-3">Packages</h5>
                    <p class="card-text text-secondary">View and edit all available packages.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
