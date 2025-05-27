<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserComponent extends Model
{
  

    protected $table = 'component';

    protected $primaryKey = 'component_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'component_name',
        'component_path',
        'component_parent',
        'component_order',
        'component_status',

    ];
}
