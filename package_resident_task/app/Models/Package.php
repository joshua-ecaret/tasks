<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Package extends Model
{
    /** @use HasFactory<\Database\Factories\PackageFactory> */
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    protected $fillable = [
        'package_name',
        'credits',
        'credits_time_unit',
        'status',
        'apply_credit_rollover',
        'max_rollover_credits',
        'start_date',
        'end_date',
    ];
    protected $casts = [
        'apply_credit_rollover' => 'boolean',
        'max_rollover_credits' => 'integer',
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',

    ];

    public function residents()
    {
        return $this->hasMany(Resident::class);
    }


    public function isActive(): bool
    {
        if ($this->status === 'Active') {
            if ($this->start_date && $this->end_date) {
                $currentDate = now();
                return $currentDate->between($this->start_date, $this->end_date);
            }
            return true;
        }
        return false;
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'Active');
    }
}
