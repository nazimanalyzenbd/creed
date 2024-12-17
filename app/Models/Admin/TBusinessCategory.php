<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class TBusinessCategory extends Model
{
    protected $guarded = [];

    public function businesses()
    {
        return $this->hasMany(\App\Models\Api\TBusiness::class, 'business_category_id');
    }

    public function subcategories()
    {
        return $this->hasMany(TBusinessSubCategory::class, 'category_id');
    }
}
