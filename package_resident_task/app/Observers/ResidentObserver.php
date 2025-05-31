<?php

namespace App\Observers;

use App\Http\Controllers\PackageController;
use App\Models\Resident;

class ResidentObserver
{
    /**
     * Handle the Resident "created" event.
     */
    public function created(Resident $resident): void
    {
        $data = $resident->toArray();
        $data['package_name'] = $resident->package->package_name;
        $data['start_date'] = $resident->package->start_date;
        $data['end_date'] = $resident->package->end_date;
        $data['status'] = $resident->package->status;
        PackageController::sendEmail($data, "Create");
    }

    /**
     * Handle the Resident "updated" event.
     */
    public function updated(Resident $resident): void
    {
        if ($resident->isDirty("package_id")) {
            $data = $resident->toArray();
            $data['package_name'] = $resident->package->package_name;
            $data['start_date'] = $resident->package->start_date;
            $data['end_date'] = $resident->package->end_date;
            $data['status'] = $resident->package->status;
            PackageController::sendEmail($data, "Edite");
        }
    }

    /**
     * Handle the Resident "deleted" event.
     */
    public function deleted(Resident $resident): void
    {
        $data = $resident->toArray();
        $data['package_name'] = $resident->package->package_name;
        $data['start_date'] = $resident->package->start_date;
        $data['end_date'] = $resident->package->end_date;
        $data['status'] = $resident->package->status;
        PackageController::sendEmail($data, "Delete");
    }

    /**
     * Handle the Resident "restored" event.
     */
    public function restored(Resident $resident): void
    {
        //
    }

    /**
     * Handle the Resident "force deleted" event.
     */
    public function forceDeleted(Resident $resident): void
    {
        //
    }
}
