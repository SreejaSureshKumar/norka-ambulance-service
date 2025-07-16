<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $table = 'm_country';

    protected $primaryKey = 'country_id';

    public function scopeActive(Builder $query)
    {
        $query->where('active', 'Y');
       
    }
}