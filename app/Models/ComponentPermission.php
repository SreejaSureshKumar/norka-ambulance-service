<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentPermission extends Model
{
    protected $table = 'component_permission';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'component_id',
        'role_id',
        'permission_status',
      

    ];
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'menu_permissions');
    }
}
