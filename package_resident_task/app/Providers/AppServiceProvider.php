<?php

namespace App\Providers;

use App\Models\Package;
use App\Models\Resident;
use App\Observers\NotifyOnUpdateObserver;
use App\Observers\PackageObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Package::observe(NotifyOnUpdateObserver::class);
        Resident::observe(NotifyOnUpdateObserver::class);
    }
}
