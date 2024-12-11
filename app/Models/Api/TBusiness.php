<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class TBusiness extends Model
{
    protected $guarded = [];

    public function businessOwnerInfos()
    {
        return $this->hasMany(TBusinessOwnerInfo::class, 'id','business_owner_id');
    }

    public function businessType()
    {
        return $this->belongsTo(\App\Models\Admin\TBusinessType::class, 'business_type_id');
    }

    public function businessCategory()
    {
        return $this->belongsTo(\App\Models\Admin\TBusinessCategory::class, 'business_category_id');
    }

    public function businessSubCategory()
    {
        return $this->belongsTo(\App\Models\Admin\TBusinessSubCategory::class, 'business_subcategory_id');
    }

    public function businessTags()
    {
        return $this->belongsTo(\App\Models\Admin\TBusinessTags::class, 'business_tags_id');
    }

    public function creedtags()
    {
        return $this->belongsTo(\App\Models\Admin\TCreedTags::class, 'creed_tags_id');
    }

    public function country()
    {
        return $this->belongsTo(\App\Models\Admin\TAdminCountry::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(\App\Models\Admin\TAdminState::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(\App\Models\Admin\TAdminCity::class, 'city_id');
    }
}
