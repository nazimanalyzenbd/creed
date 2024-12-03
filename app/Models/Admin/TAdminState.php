<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TAdminState extends Model
{
    protected $guarded = [];

    public function cities(){
        return $this->hasMany(City::class);
    }
   
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
