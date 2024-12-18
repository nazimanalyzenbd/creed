<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class TBusiness extends Model
{
    protected $guarded = [];

    public function businessOwnerInfos()
    {
        return $this->hasMany(TBusinessOwnerInfo::class, 'business_id');
    }

    protected $casts = [
        'business_type_id' => 'array',
        'affiliation_id' => 'array',
        'creed_tag_id' => 'array',
    ];

    // public function businessType()
    // {
    //     // return $this->belongsTo(\App\Models\Admin\TBusinessType::class, 'business_type_id');
    // }

    public function getBusinessTypeNameAttribute()
    {
        $typeIds = array_map('intval', $this->business_type_id ?? []);
        
        return \App\Models\Admin\TBusinessType::whereIn('id', $typeIds)
                  ->pluck('name')
                  ->toArray();
    }

    public function getAffiliationNameAttribute()
    {
        $affiliationIds = array_map('intval', $this->affiliation_id ?? []);
        
        return \App\Models\Admin\TAdminAffiliation::whereIn('id', $affiliationIds)
                  ->pluck('name')
                  ->toArray();
    }

    public function getCreedeTagsNameAttribute()
    {
        $creedTagsIds = array_map('intval', $this->creed_tag_id ?? []);
        
        return \App\Models\Admin\TCreedTags::whereIn('id', $creedTagsIds)
                  ->pluck('name')
                  ->toArray();
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

    // public function creedTags()
    // {
    //     return $this->belongsTo(\App\Models\Admin\TCreedTags::class, 'creed_tags_id');
    // }

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
