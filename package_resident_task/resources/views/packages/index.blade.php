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
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.body.addEventListener('click', function (e) {
        if (e.target.closest('.btn-delete')) {
            const button = e.target.closest('.btn-delete');
            const form = button.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: 'This will permanently delete the package.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});

</script>
@endpush
