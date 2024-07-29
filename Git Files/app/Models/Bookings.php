<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'firstname', 'lastname', 'vehicleType', 'option', 'start_date', 'end_date'
    ];
    public $timestamps = false;
}
