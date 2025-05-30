<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComponentPermission extends Model
{
    protected $table = 'component_permissions';

    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'component_id',
        'usertype_id',
        'permission_status',
      

    ];
      /**
     * Define the relationship with the UserType model.
     * A ComponentPermission belongs to a UserType.
     */
    public function usertype()
    {
        return $this->belongsTo(UserType::class, 'usertype_id');
    }

    /**
     * Define the relationship with the Component model.
     * A ComponentPermission belongs to a Component.
     */
    public function component()
    {
        return $this->belongsTo(UserComponent::class, 'component_id');
    }
}
