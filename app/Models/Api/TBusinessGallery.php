<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBusinessGallery extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];
    
}
