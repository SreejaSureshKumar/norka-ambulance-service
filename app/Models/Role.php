<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;
use App\Models\UserComponent;
use App\Models\ComponentPermission;

class Role extends SpatieRole
{
    public function components()
    {
        
            return $this->hasMany(ComponentPermission::class,'role_id');
        }
  
}
