<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TAdminState extends Model
{
    protected $guarded = [];

    public function cities(){
        return $this->hasMany(TAdminCity::class, 'state_id');
    }
   
    public function country(){
        return $this->belongsTo(TAdminCountry::class);
    }
}
