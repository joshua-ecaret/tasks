<?php
namespace App\Enums;

enum ResidentStatus: string
{
    case Active = 'Active';
    case Inactive = 'Inactive';

    public function toggle(): ResidentStatus
    {
        return $this === self::Active ? self::Inactive : self::Active;
    }
}
