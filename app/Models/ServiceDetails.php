<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDetails extends Model
{
    use HasFactory;
    protected $table = 'service_details';

    protected $primaryKey = 'id';
    protected $fillable = [
        'application_id',
        'source_location',
        'destination_location',
        'total_distance',
        'amount',
        'attachment_path',
        'created_by',
        'created_at',
    ];

    public function serviceApplication()
    {
        return $this->belongsTo(ServiceApplication::class, 'application_id', 'id');
    }
}
