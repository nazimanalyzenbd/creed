<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TBusiness extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    protected $dates = ['deleted_at'];

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
        $typeIds = is_string($this->business_type_id)
        ? json_decode($this->business_type_id, true)
        : $this->business_type_id;

        $typeIds = is_array($typeIds) ? array_map('intval', $typeIds) : [];
        
        return \App\Models\Admin\TBusinessType::whereIn('id', $typeIds)
                  ->pluck('name')
                  ->toArray();
    }

    public function getAffiliationNameAttribute()
    {
        // $affiliationIds = array_map('intval', $this->affiliation_id ?? []);
        $affiliationIds = is_string($this->affiliation_id)
        ? json_decode($this->affiliation_id, true)
        : $this->affiliation_id;

        $affiliationIds = is_array($affiliationIds) ? array_map('intval', $affiliationIds) : [];
        
        return \App\Models\Admin\TAdminAffiliation::whereIn('id', $affiliationIds)
                  ->pluck('name')
                  ->toArray();
    }

    public function getCreedTagsNameAttribute()
    {
        $creedTagsIds = is_string($this->creed_tags_id)
        ? json_decode($this->creed_tags_id, true)
        : $this->creed_tags_id;

        $creedTagsIds = is_array($creedTagsIds) ? array_map('intval', $creedTagsIds) : [];
        
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

    public function countryName()
    {
        return $this->belongsTo(\App\Models\Admin\TAdminCountry::class, 'country','id');
    }

    public function stateName()
    {
        return $this->belongsTo(\App\Models\Admin\TAdminState::class, 'state','id');
    }

    public function cityName()
    {
        return $this->belongsTo(\App\Models\Admin\TAdminCity::class, 'city','id');
    }

    public function operationData(){
        return $this->hasMany(\App\Models\Api\TOperationHour::class, 'business_id');
    }

    public function galleryData(){
        return $this->hasMany(\App\Models\Api\TBusinessGallery::class, 'business_id');
    }

    public function ratings()
    {
        return $this->hasMany(\App\Models\Api\TBusinessRating::class, 'business_id');
    }

    public function averageRating()
    {
        $avarage = $this->ratings()->avg('rating_star');
        return number_format($avarage, 1);
    }
}
