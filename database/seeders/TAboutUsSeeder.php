<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin\TAboutUs;

class TAboutUsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tAboutUs = TAboutUs::insert([
            [
                'individual_title' => 'CREED is a Commerce Platform & Global Business Directory Serving The Muslim Community', 
                'business_title' => 'CREED is a Global Business Directory Serving the Muslim Community', 
                'individual_description' => json_encode(['Our mission is to:',
                                'list' =>['1.Connect Businesses to Muslims (B2C and B2B)',
                                    'sublist' =>['a.Business to Consumer - Connect   with your customer and grow your business!',
                                    'b.Business to Business - Connect to our CREED B2B Ecosystem'], 
                                '2.Engage, empower, and serve the ummah.'],
                                'Simply put, If you are a Muslim owned, Muslim operated, or a business that has a specific offering for the Muslim community, your business should be on CREED']),
                'business_description' => json_encode(['Our mission is to:',
                                'list' =>['1.Connect Muslims to Businesses that are serving them', 
                                'sublist' =>['a. Business to Consumer - Connect with your customer and grow your business!', 
                                'b. Business to Business - Connect to our CREED B2B Ecosystem! (coming soon)'],
                                '2.Engage, empower, and serve the ummah.'],
                                'Simply put, If you are a business that has a specific offering for the Muslim community, your business should be on CREED, Global Business Directory Serving The Muslim Community.']),                
                'individual_tab_description' => json_encode(['For Consumers (tab)',
                                '1.Search businesses that are serving the Muslim community.',
                                '2.Filter based on your CREED preferences (CREED Tags).',
                                '3.Find the perfect business that matches your CREED and meets your needs.']),
                'business_tab_description' => json_encode(['1.List your business/organization on CREED!',
                                '2.Share, Create Promos, Marketing Campaigns and Grow Your Business!',
                                '3.Gain business insights on your personalized business portal, where you can:',
                                '4.Gain valuable customer, market, and business insight metrics',
                                '5.Receive tips and tricks on how to grow your business',
                                '6.Manage your business listing to help reach your target audience',
                                '7.Connect with other businesses within your industry (B2B Ecosystem coming soon)']),
                'created_by' => '1',
            ],
        ]);
    }
}
