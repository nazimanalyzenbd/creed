<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TBusinessSubCategory extends Model
{
    public function businesses()
    {
        return $this->hasMany(\App\Models\Api\TBusiness::class, 'business_subcategory_id');
    }

    public function category()
    {
        return $this->belongsTo(TBusinessCategory::class, 'category_id');
    }
}
