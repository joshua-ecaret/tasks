<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'package_name',
        'credits',
        'credits_time_unit',
        'status',
        'apply_credit_rollover',
        'max_rollover_credits',
        'start_date',
        'end_date'
    ];

}
