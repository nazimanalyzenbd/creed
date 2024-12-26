<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TAdminCity extends Model
{
    protected $guarded = [];

    public function state(){
        return $this->belongsTo(TAdminState::class);
    }
}
