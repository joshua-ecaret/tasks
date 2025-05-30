@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h2 class="mb-3">{{ __('learn.greeting') }} <strong>{{ __('learn.name') }}</strong></h2>

                        <p class="text-muted mb-1">From: <em>{{ __('learn.country') }}</em></p>
                        <blockquote class="blockquote mt-4">
                            <p class="mb-0 fs-5 fst-italic">"{{ __('learn.quote') }}"</p>
                        </blockquote>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection