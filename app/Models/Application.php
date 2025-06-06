<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;
    protected $table = 'deceased_person_details';

    protected $primaryKey = 'id';
    protected $fillable = [
        'application_no',
        'deceased_person_name',
        'passport_no',
        'country',
        'death_date',
        'cause_of_death',
        'sponsor_details',
        'contact_abroad_name',
        'contact_abroad_phone',
        'contact_kerala_name',
        'contact_kerala_phone',
        'airport_from',
        'airport_to',
        'native_address',
        'cargo_norka_status',
        'application_status',
        'application_number',
        'created_by',
        'processed_by',
        'processed_date',
        'remarks'
    ];

    public function countryRelation()
    {
        return $this->belongsTo(Country::class, 'country', 'country_id');
    }
    public function processedUser()
    {
        return $this->belongsTo(User::class, 'processed_by', 'id');
    }
}
