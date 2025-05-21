<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PackageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->package_name,
            'credits' => $this->credits,
            'time_unit' => $this->credits_time_unit,
            'status' => $this->status,
            'apply_credit_rollover' => $this->apply_credit_rollover,
            'max_rollover_credits' => $this->when(
                $this->apply_credit_rollover,
                $this->max_rollover_credits
            ),
        ];

    }
}
