@extends('layouts.app')
 
@section('content')
    <div class="container py-5">
        <div class="card">
            <div class="card-header">Manage Packages</div>
            <div class="card-body">
                <div class="table-responsive">

                <table class="table table-striped">
                {{ $dataTable->table() }}
                </table>
                </div>
            </div>
        </div>
    </div>
@endsection
 
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush