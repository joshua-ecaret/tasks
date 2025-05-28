@extends('layouts.app')
 
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Manage Packages</span>
                <a href="{{ route('packages.create') }}" class="btn btn-primary btn-sm">
                    + Create Package
                </a>
            </div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>

    </div>
<div>

</div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
