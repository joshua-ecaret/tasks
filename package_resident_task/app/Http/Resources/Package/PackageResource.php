<?php

namespace App\Http\Resources\Package;

// Corrected namespace as per the error message

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\Package
 */
class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [ // No need for (array) cast here
            'id' => $this->id,
            'name' => $this->package_name,
            'credits' => $this->credits,
            'time_unit' => $this->credits_time_unit,
            'status' => $this->status,
            'apply_credit_rollover' => $this->apply_credit_rollover,
            'max_rollover_credits' => $this->apply_credit_rollover
                ? $this->max_rollover_credits
                : null,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}
