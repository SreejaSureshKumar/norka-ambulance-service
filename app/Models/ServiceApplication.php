<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceApplication extends Model
{
    use HasFactory;
    protected $table = 'ambulance_service_details';

    protected $primaryKey = 'id';
    protected $fillable = [
        'application_no',
        'deceased_person_name',
        'passport_no',
        'country',
        'state',
        'district',
        'departure_date_time',
        'arriving_date_time',
        'contact_abroad_name',
        'contact_abroad_phone',
        'contact_local_name',
        'contact_local_phone',
        'alt_contact_abroad_name',
        'alt_contact_local_name',
        'alt_contact_local_phone',
        'alt_contact_abroad_phone',
        'flight_no',
        'native_address',
        'application_attachment',
        'application_status',
        'created_by',
        'processed_by',
        'processed_date',
        'remarks',
        'intimation_flag',
        'agency_id',
        'arrival_airport',
        'approval_remarks',
        'approved_date',
        'approved_by',  
    ];

    public function countryRelation()
    {
        return $this->belongsTo(Country::class, 'country', 'country_id');
    }
    public function processedUser()
    {
        return $this->belongsTo(User::class, 'processed_by', 'id');
    }
    public function stateRelation()
    {
        return $this->belongsTo(State::class, 'state');
    }

    public function districtRelation()
    {
        return $this->belongsTo(District::class, 'district');
    }
    public function driverDetails()
    {
        return $this->hasOne(DriverDetails::class, 'application_id', 'id');
    }
    public function agencyUser()
    {
        return $this->belongsTo(User::class, 'agency_id', 'id');
    }
    public function serviceDetails()
    {
        return $this->hasOne(ServiceDetails::class, 'application_id', 'id');
    }
      public function approvedUser()
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
