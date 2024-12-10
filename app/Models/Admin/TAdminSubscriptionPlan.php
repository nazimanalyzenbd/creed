<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TAdminSubscriptionPlan extends Model
{
    protected $guarded = [];

    public function country(){
        return $this->belongsTo(TAdminCountry::class);
    }
}
