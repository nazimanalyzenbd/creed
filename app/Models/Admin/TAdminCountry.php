<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TAdminCountry extends Model
{
    protected $guarded = [];

    public function states(){
        return $this->hasMany(State::class);
    }
   
    public function statesWithCities(){
        return $this->states()->with('cities');
    }
}
