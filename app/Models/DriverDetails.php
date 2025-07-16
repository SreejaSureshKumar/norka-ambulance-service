<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DriverDetails extends Model
{
    use HasFactory;
    protected $table = 'driver_details';

    protected $primaryKey = 'details_id';
    protected $fillable = [
       
        'driver_name',
        'mobile',
        'address',
        'application_id',
        'created_by',
        'created_at',


    ];
}
