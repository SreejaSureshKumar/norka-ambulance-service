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
        'vehicle_number',
        'application_id',
        'created_by',
        'created_at',


    ];
    public function serviceApplication()
    {
        return $this->belongsTo(ServiceApplication::class, 'application_id', 'id');
    }
}
