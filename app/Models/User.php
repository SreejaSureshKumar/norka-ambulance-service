<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles; // Add this line
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasRoles, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type', // Assuming this is the foreign key for UserType
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function userType()
    {
        return $this->belongsTo(UserType::class, 'user_type');
    }

   
    public function getCurrentUserPermissions()
    {
        $user_type = UserType::find($this->user_type);// Assuming userType is a relationship or property

        if ($user_type && method_exists($user_type, 'activeModules')) {
            $permissions = $user_type->activeModules()->get();
        } else {
            $permissions = []; // Fallback to an empty array or default permissions
        }
        return $permissions;
        // $user_type = UserType::find($this->user_type);
        // return $user_type->activeModules()->get();
    }

}
