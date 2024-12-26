<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TAdminCountry extends Model
{
    protected $guarded = [];

    public function states(){
        return $this->hasMany(TAdminState::class, 'country_id');
    }
   
    public function statesWithCities(){
        return $this->states()->with('cities');
    }
}
