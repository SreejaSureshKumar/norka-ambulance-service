<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceApplicationAttachment extends Model
{
     protected $table = 'ambulance_service_attachments';

    protected $primaryKey = 'attachment_id';
    protected $fillable = [
        'application_id',
        'attachment_path',
        'status'
    ];
}
