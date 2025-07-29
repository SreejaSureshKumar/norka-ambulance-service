<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationBatch extends Model
{
    use HasFactory;
    protected $table = 'application_batch';

    protected $primaryKey = 'batch_id';
    protected $fillable = [
        'batch_no',
        'serial_number',
        'total_applications',
        'created_by',
       
    ];

}
