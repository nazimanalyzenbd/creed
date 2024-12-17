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
                'title' => 'CREED is a Global Business Directory Serving the Muslim Community', 
                'description' => 'Our mission is to:
                                1.Connect Muslims to Businesses that are serving them a. Business to Consumer - Connect with your customer and grow your business! b. Business to Business - Connect to our CREED B2B Ecosystem! (coming soon)
                                2.Engage, empower, and serve the ummah.
                                Simply put, If you are a business that has a specific offering for the Muslim community, your business should be on CREED, Global Business Directory Serving The Muslim Community.',
                'individual_description' => 'For Consumers (tab)
                                1.Search businesses that are serving the Muslim community.
                                2.Filter based on your CREED preferences (CREED Tags).
                                3.Find the perfect business that matches your CREED and meets your needs.',
                'business_description' => '1.List your business on CREED!
                                2.Share, Create Promos, Marketing Campaigns and Grow Your Business!
                                3.Gain business insights on your personalized business portal, where you can:a. Gain valuable customer, market, and business insight metrics.b. Receive tips and tricks on how to grow your business.c. Manage your business listing to help reach your target audience.
                                4.Connect with other businesses within your industry (B2B Ecosystem coming soon).
                                Yes it`s that simple!Get started today by listing your business for FREE (for 3 months)!*
                                What makes CREED Different
                                1.We only list businesses that serve the Muslim community.
                                2.We do not work with businesses whose main source of income does not align with Islamic principles.
                                3.We aim to screen our listings to ensure that there is:a. No adult content.b. No usury/interest.c. No alcohol.d. No illegal drugs.e. No gambling.f. No explicitly stated Haram products or services.
                                4.Family friendly, easily accessible, and global: No matter where you are, easily find businesses serving you (the Muslim consumer) at your fingertips.',
                'created_by' => '1',
            ],
        ]);
    }
}
