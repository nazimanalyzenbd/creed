<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class TBusinessOwnerInfo extends Model
{
    protected $guarded = [];

    public function business()
    {
        return $this->belongsTo(Business::class, 'business_id');
    }

    public function users(){
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
