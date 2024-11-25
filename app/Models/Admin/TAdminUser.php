<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class TAdminUser extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    protected $table = 't_admin_users';

    protected $fillable = [
        'name', 'email', 'password',  'phone_number', 'address', 'country', 'state', 'city', 'zip_code'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
