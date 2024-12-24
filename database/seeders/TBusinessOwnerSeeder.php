<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Api\TBusinessOwnerInfo;
use App\Models\Api\TBusiness;
use App\Models\Api\TOperationHour;
use App\Models\Api\TBusinessGallery;

class TBusinessOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tUser = User::insert([
            [
                'email' => 'azam.hh@gmail.com',
                'password' => '12345678', 
            ],
            [
                'email' => 'azam.hh@gmail.com',
                'password' => '12345678',  
            ],
            [
                'email' => 'Mikaeel@gmail.com',
                'password' => '12345678', 
            ],
            [
                'email' => 'Sana@gmail.com',
                'password' => '12345678', 
            ],
            [
                'email' => 'azam.hh@gmail.com',
                'password' => '12345678', 
            ],
            [
                'email' => 'Hal@gmail.com',
                'password' => '12345678', 
            ],
        ]);
        $tBusinessOwnerInfo = TBusinessOwnerInfo::insert([
            [
                'first_name' => 'Azam',
                'last_name' => 'Hassim', 
                'email' => 'azam.hh@gmail.com', 
                'phone_number' => '4086930134', 
                'address' => '21329 Gosier Way', 
            ],
            [
                'first_name' => 'Surah',
                'last_name' => 'Hassim', 
                'email' => 'azam.hh@gmail.com', 
                'phone_number' => '1234567890', 
                'address' => '20423 US-441 Suite F18', 
            ],
            [
                'first_name' => 'Mikaeel',
                'last_name' => 'Hassim', 
                'email' => 'Mikaeel@gmail.com', 
                'phone_number' => '2345678901', 
                'address' => '8185 Via Ancho Rd', 
            ],
            [
                'first_name' => 'Sana',
                'last_name' => 'Shaikh', 
                'email' => 'Sana@gmail.com', 
                'phone_number' => '4444444444', 
                'address' => '2005 Greenbriar Blvd', 
            ],
            [
                'first_name' => 'Azam',
                'last_name' => 'Hassim', 
                'email' => 'azam.hh@gmail.com', 
                'phone_number' => '5557890345', 
                'address' => '19196 Natures View Ct', 
            ],
            [
                'first_name' => 'Hal',
                'last_name' => 'Al', 
                'email' => 'Hal@gmail.com', 
                'phone_number' => '8888888888', 
                'address' => '7501 Harwin Dr. #101e',  
            ],
        ]);
        $tBusiness = TBusiness::insert([
            [
                'business_owner_id' => 1,
                'business_name' => 'Five Pillars Ventures LLC',
                'business_type_id' => [1], 
                'business_category_id' => 1, 
                'creed_tags_id' => [1,2,3], 
                'restaurant_id' => [1],
                'address' => '21329 Gosier Way',
                'lat' => '26.3562011',
                'long' => '-80.2474052',
                'country' => '',
                'state' => '',
                'city' => '',
                'zip_code' => '33428',
                'business_description' => 'app development information technology consulting',
            ],
            [
                'business_owner_id' => 2,
                'business_name' => 'Five Pillars Ventures LLC',
                'business_type_id' => [2], 
                'business_category_id' => 2, 
                'creed_tags_id' => [1,2,3], 
                'restaurant_id' => [1],
                'address' => '',
                'lat' => '26.3767221',
                'long' => '-80.2065753',
                'country' => '',
                'state' => '',
                'city' => '',
                'zip_code' => '33498', 
                'business_description' => 'Dental Surgeon Dentist Dental Hygeine',
            ],
            [
                'business_owner_id' => 3,
                'business_name' => 'Five Pillars Ventures LLC',
                'business_type_id' => [3], 
                'business_category_id' => 3, 
                'creed_tags_id' => [1,2,3], 
                'restaurant_id' => [1],
                'address' => '8185 Via Ancho Rd',
                'lat' => '26.3612422',
                'long' => '-80.1785146',
                'country' => '',
                'state' => '',
                'city' => '',
                'zip_code' => '33488', 
                'business_description' => 'Lawyer Family Law Probate Custody Divorce',
            ],
            [
                'business_owner_id' => 4,
                'business_name' => 'Five Pillars Ventures LLC',
                'business_type_id' => [1], 
                'business_category_id' => 4, 
                'creed_tags_id' => [1,2,3], 
                'restaurant_id' => [1],
                'address' => '2005 Greenbriar Blvd',
                'lat' => '26.6456944',
                'long' => '-80.2919912',
                'country' => '',
                'state' => '',
                'city' => '',
                'zip_code' => '33414',
                'business_description' => 'event planning parties corporate events birthday planner wedding fun outdoor florida event planner',
            ],
            [
                'business_owner_id' => 5,
                'business_name' => 'Five Pillars Ventures LLC',
                'business_type_id' => [1], 
                'business_category_id' => 5, 
                'creed_tags_id' => [1,2,3], 
                'restaurant_id' => [1],
                'address' => '19196 Natures View Ct',
                'lat' => '26.3898274',
                'long' => '-80.236841',
                'country' => '',
                'state' => '',
                'city' => '',
                'zip_code' => '33498',
                'business_description' => 'halal yemeni arab restaurant',
            ],
            [
                'business_owner_id' => 6,
                'business_name' => 'Five Pillars Ventures LLC',
                'business_type_id' => [1], 
                'business_category_id' => 5, 
                'creed_tags_id' => [3], 
                'restaurant_id' => [1],
                'address' => '7501 Harwin Dr. #101e',
                'lat' => '29.7163364',
                'long' => '-95.5196025',
                'country' => '',
                'state' => '',
                'city' => '',
                'zip_code' => '77036',  
                'business_description' => 'Halal Italian Restaurant pizza pasta',
            ],
        ]);
    }
}
