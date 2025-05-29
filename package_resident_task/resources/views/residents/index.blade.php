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

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.body.addEventListener('click', function (e) {
                if (e.target.closest('.btn-delete')) {
                    const button = e.target.closest('.btn-delete');
                    const form = button.closest('form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: 'This will permanently delete the resident.',
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

            document.addEventListener('change', function (e) {
                if (e.target.classList.contains('status-toggle-checkbox')) {
                    e.preventDefault();
                    const checkbox = e.target;
                    const form = checkbox.closest('form');
                    const isChecked = checkbox.checked;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: `Do you want to ${isChecked ? 'activate' : 'deactivate'} this resident?`,
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Yes',
                        cancelButtonText: 'Cancel',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        } else {
                            checkbox.checked = !isChecked;
                        }
                    });
                }
            });
        });


    </script>
@endpush