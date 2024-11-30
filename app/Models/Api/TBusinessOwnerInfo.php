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
}
