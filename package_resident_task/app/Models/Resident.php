<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    /** @use HasFactory<\Database\Factories\ResidentFactory> */
    use HasFactory;

    protected $fillable = [
        "resident_name",
        "email",
        "phone",
        "package_id"
    ];
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
