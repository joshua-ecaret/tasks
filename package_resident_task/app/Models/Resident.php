<?php

namespace App\Models;


use App\Enums\ResidentStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Resident extends Model
{
    /** @use HasFactory<\Database\Factories\ResidentFactory> */
    use HasFactory;

    use SoftDeletes;
    protected $fillable = [
        "resident_name",
        "email",
        "phone",
        "package_id",
        "status"
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function toggleStatus(): void
    {
        $this->status = $this->status->toggle();
        $this->save();
    }


    protected $casts = [
        'status' => ResidentStatus::class,
    ];
}
