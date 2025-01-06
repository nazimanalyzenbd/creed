<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'google_id',
        'avatar',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'account_type',
        'otp',
        'otp_expires_at',
        'otp_sttaus',
        'owner_id',
        'status'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function businessOwnerInfos()
    {
        return $this->hasMany(\App\Models\Api\TBusinessOwnerInfo::class, 'user_id');
    }

    public function businesses()
    {
        return $this->hasManyThrough(\App\Models\Api\TBusiness::class, 'user_id', 'owner_info_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($user) {
            if ($user->isForceDeleting()) {
                $user->businessOwnerInfos()->forceDelete(); // Hard delete related data
            } else {
                $user->businessOwnerInfos()->delete(); // Soft delete related data
            }
        });

        static::restoring(function ($user) {
            $user->businessOwnerInfos()->withTrashed()->restore(); // Restore related data
        });
    }

}
