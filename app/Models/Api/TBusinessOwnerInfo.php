<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBusinessOwnerInfo extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function business()
    {
        return $this->belongsTo(TBusiness::class, 'business_id');
    }

    public function users(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($ownerInfo) {
            if ($ownerInfo->isForceDeleting()) {
                $ownerInfo->business()->forceDelete(); // Hard delete related data
            } else {
                $ownerInfo->business()->delete(); // Soft delete related data
            }
        });

        static::restoring(function ($ownerInfo) {
            $ownerInfo->business()->withTrashed()->restore(); // Restore related data
        });
    }
}
