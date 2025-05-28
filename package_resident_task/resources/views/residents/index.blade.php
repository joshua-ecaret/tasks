@extends('layouts.app')
 
@section('content')

    <div class="container">
        <div class="card bg-layout">
            <div class="card-header text-white bg-nav-dark d-flex justify-content-between align-items-center">
                <span>Manage Residents</span>
                <a href="{{ route('residents.create') }}" class="btn bg-v-light btn-sm">
                    + Create Resident
                </a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush