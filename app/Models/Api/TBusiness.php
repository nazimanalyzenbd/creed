<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class TBusiness extends Model
{
    protected $guarded = [];

    public function businessOwnerInfos()
    {
        return $this->hasMany(BusinessOwnerInfo::class);
    }
}
