<?php

namespace App\Models\Sanctum; // place your file to Models/Sanctum/PersonalAccessToken.php
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalAccessToken extends SanctumPersonalAccessToken
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];
}
