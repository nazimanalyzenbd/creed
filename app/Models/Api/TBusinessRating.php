<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBusinessRating extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function businessList()
    {
        return $this->belongsTo(\App\Models\Api\TBusiness::class);
    }
}
