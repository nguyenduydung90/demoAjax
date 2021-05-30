<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyBike extends Model
{
    use HasFactory;
    protected $table='agencybike';
    protected $fillable=[
        'egency_name',
        'phone',
        'email',
        'address',
        'manage',
        'status'

    ];
}
