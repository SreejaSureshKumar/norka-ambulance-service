<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'usertype';

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'usertype_name',
        'usertype_status',
        
    ];
    public function permissions()
    {
        return $this->hasMany(ComponentPermission::class, 'usertype_id', 'id');
    }

    public function activeModules() {
       return $this->permissions()->join('component', 'component_permissions.component_id', '=', 'component.component_id')->where('component_permissions.permission_status', 1)->orderBy('component.component_order');
   
   
    }
}
