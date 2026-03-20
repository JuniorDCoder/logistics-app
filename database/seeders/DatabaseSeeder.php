<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Setting;
use App\Models\Service;
use App\Models\Testimonial;
use App\Models\TeamMember;
use App\Models\Shipment;
use App\Models\TrackingEvent;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@logistics.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Settings
        $settings = [
            // General
            ['key'=>'app_name',        'value'=>'IntertransitLogistics', 'group'=>'general',  'type'=>'text',     'label'=>'Application Name'],
            ['key'=>'tagline',         'value'=>'Professional Logistics Services with Seamless Process', 'group'=>'general', 'type'=>'text', 'label'=>'Tagline'],
            ['key'=>'contact_email',   'value'=>'support@intertransitlogistics.org', 'group'=>'general', 'type'=>'text', 'label'=>'Contact Email'],
            ['key'=>'contact_phone',   'value'=>'+1 (800) 555-0100', 'group'=>'general', 'type'=>'text', 'label'=>'Contact Phone'],
            ['key'=>'contact_address', 'value'=>'123 Logistics Ave, Sydney, Australia', 'group'=>'general', 'type'=>'text', 'label'=>'Address'],
            ['key'=>'office_hours',    'value'=>'Mon-Sat: 08:00am - 10:00pm', 'group'=>'general', 'type'=>'text', 'label'=>'Office Hours'],
            ['key'=>'logo',            'value'=>'', 'group'=>'general', 'type'=>'image', 'label'=>'Logo'],
            // Social
            ['key'=>'facebook',        'value'=>'#', 'group'=>'social', 'type'=>'text', 'label'=>'Facebook URL'],
            ['key'=>'twitter',         'value'=>'#', 'group'=>'social', 'type'=>'text', 'label'=>'Twitter URL'],
            ['key'=>'linkedin',        'value'=>'#', 'group'=>'social', 'type'=>'text', 'label'=>'LinkedIn URL'],
            ['key'=>'instagram',       'value'=>'#', 'group'=>'social', 'type'=>'text', 'label'=>'Instagram URL'],
            // Homepage
            ['key'=>'hero_title',      'value'=>'Professional Logistics Services with Seamless Process', 'group'=>'homepage', 'type'=>'text', 'label'=>'Hero Title'],
            ['key'=>'hero_subtitle',   'value'=>'Our digital freight platform delivers value throughout your supply chain, integrating our TMS with your systems via API and EDI.', 'group'=>'homepage', 'type'=>'textarea', 'label'=>'Hero Subtitle'],
            ['key'=>'stats_years',     'value'=>'15', 'group'=>'homepage', 'type'=>'text', 'label'=>'Years of Experience'],
            ['key'=>'stats_workers',   'value'=>'2000', 'group'=>'homepage', 'type'=>'text', 'label'=>'Company Workers'],
            ['key'=>'stats_shipments', 'value'=>'50', 'group'=>'homepage', 'type'=>'text', 'label'=>'Shipments (thousands)'],
            ['key'=>'stats_customers', 'value'=>'98', 'group'=>'homepage', 'type'=>'text', 'label'=>'Satisfied Customers (%)'],
            // SEO
            ['key'=>'meta_description','value'=>'Professional logistics and freight services. Air freight, ocean freight, road freight and customs clearance worldwide.', 'group'=>'seo', 'type'=>'textarea', 'label'=>'Meta Description'],
            ['key'=>'meta_keywords',   'value'=>'logistics, freight, shipping, air freight, ocean freight, customs clearance', 'group'=>'seo', 'type'=>'text', 'label'=>'Meta Keywords'],
        ];

        foreach ($settings as $s) {
            Setting::create($s);
        }

        // Services
        $services = [
            ['title'=>'Air Freight',      'slug'=>'air-freight',      'icon'=>'fa-plane',        'short_description'=>'Fast and reliable air cargo solutions for time-sensitive shipments worldwide.', 'description'=>'<p>Our air freight services offer the fastest transit times for your urgent shipments. With partnerships with over 100 airlines, we ensure your cargo reaches any destination globally in the shortest possible time.</p><p>We handle everything from small packages to oversized cargo, providing door-to-door service with real-time tracking.</p>', 'sort_order'=>1],
            ['title'=>'Ocean Freight',    'slug'=>'ocean-freight',    'icon'=>'fa-ship',         'short_description'=>'Cost-effective sea freight for large volume shipments across global trade lanes.', 'description'=>'<p>Our ocean freight solutions cover FCL (Full Container Load) and LCL (Less than Container Load) options, giving you flexibility based on your cargo volume and budget.</p><p>With access to major shipping lines and ports worldwide, we ensure your goods arrive safely and on time.</p>', 'sort_order'=>2],
            ['title'=>'Road Freight',     'slug'=>'road-freight',     'icon'=>'fa-truck',        'short_description'=>'Comprehensive land transport solutions with nationwide and cross-border coverage.', 'description'=>'<p>Our road freight network covers domestic and international routes, providing reliable and cost-effective ground transportation solutions. From full truckloads to groupage services, we tailor our offering to your needs.</p>', 'sort_order'=>3],
            ['title'=>'Customs Clearance','slug'=>'customs-clearance','icon'=>'fa-file-contract','short_description'=>'Expert customs brokerage services to ensure smooth and compliant border crossings.', 'description'=>'<p>Navigating customs regulations can be complex. Our team of experienced customs brokers ensures your shipments comply with all import and export regulations, minimizing delays and avoiding penalties.</p>', 'sort_order'=>4],
            ['title'=>'Warehousing',      'slug'=>'warehousing',      'icon'=>'fa-warehouse',    'short_description'=>'State-of-the-art warehousing and distribution services across strategic locations.', 'description'=>'<p>Our modern warehouse facilities are strategically located near major ports and transportation hubs. We offer short and long-term storage, pick and pack services, inventory management, and distribution solutions.</p>', 'sort_order'=>5],
            ['title'=>'Sourcing & Supply','slug'=>'sourcing-supply',  'icon'=>'fa-boxes-stacked','short_description'=>'End-to-end supply chain solutions connecting your business with global suppliers.', 'description'=>'<p>We help you source products from global markets, managing supplier relationships, quality control, and the entire supply chain from procurement to delivery at your doorstep.</p>', 'sort_order'=>6],
        ];

        foreach ($services as $s) {
            Service::create(array_merge($s, ['is_active' => true]));
        }

        // Testimonials
        $testimonials = [
            ['name'=>'Jennifer McDwyer',    'position'=>'Operations Manager', 'company'=>'GlobalTrade Co.', 'content'=>'Thank you all for your hard work and patience this year – as usual you have gone above and beyond to help in any way you could. Our supply chain has never been more efficient.', 'rating'=>5],
            ['name'=>'Matthew Chamberlain', 'position'=>'CEO',               'company'=>'Pacific Imports', 'content'=>'Very efficient. Great people to deal with. These guys have taken on our international freight from overseas and have held our hand through the challenging processes.', 'rating'=>5],
            ['name'=>'Leighton Wiggins',    'position'=>'Logistics Director', 'company'=>'Artisan Exports', 'content'=>'The team at IntertransitLogistics consistently delivers exceptional service. Their real-time tracking system gives us full visibility over our shipments at all times.', 'rating'=>5],
            ['name'=>'Angela Bowman',       'position'=>'Supply Chain Manager','company'=>'Meridian Group', 'content'=>'Professional, reliable and always available. They have streamlined our entire import process and reduced our lead times by 30%. Highly recommended!', 'rating'=>5],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create(array_merge($t, ['is_active' => true]));
        }

        // Team members
        $team = [
            ['name'=>'Robert Anderson', 'position'=>'Chief Executive Officer',    'bio'=>'With over 20 years in global logistics, Robert leads our company vision and strategic direction.', 'sort_order'=>1],
            ['name'=>'Sarah Mitchell',  'position'=>'Head of Operations',          'bio'=>'Sarah oversees our global operations network ensuring seamless service delivery across all channels.', 'sort_order'=>2],
            ['name'=>'James Okafor',    'position'=>'Director of Air Freight',     'bio'=>'James manages our airline partnerships and air cargo operations across 6 continents.', 'sort_order'=>3],
            ['name'=>'Lisa Chen',       'position'=>'Head of Customs & Compliance','bio'=>'Lisa leads our customs brokerage team with expertise in international trade regulations.', 'sort_order'=>4],
        ];

        foreach ($team as $t) {
            TeamMember::create(array_merge($t, ['is_active' => true]));
        }

        // Demo shipment
        $shipment = Shipment::create([
            'tracking_number'   => Shipment::demoTrackingNumber(),
            'sender_name'       => 'John Doe',
            'sender_email'      => 'john@example.com',
            'sender_phone'      => '+1 234 567 8900',
            'sender_address'    => '123 Main St, New York, USA',
            'receiver_name'     => 'Jane Smith',
            'receiver_email'    => 'jane@example.com',
            'receiver_phone'    => '+44 20 1234 5678',
            'receiver_address'  => '456 High St, London, UK',
            'origin'            => 'New York, USA',
            'destination'       => 'London, UK',
            'service_type'      => 'air_freight',
            'weight'            => 25.5,
            'dimensions'        => '60x40x30 cm',
            'description'       => 'Electronic equipment',
            'status'            => 'in_transit',
            'estimated_delivery'=> now()->addDays(3),
            'package_count'     => 2,
            'declared_value'    => 1500.00,
        ]);

        $events = [
            ['status'=>'picked_up',  'location'=>'New York, USA',       'description'=>'Package picked up from sender.',             'event_time'=>now()->subDays(2)],
            ['status'=>'in_transit', 'location'=>'JFK Airport, USA',    'description'=>'Shipment departed JFK International Airport.','event_time'=>now()->subDays(1)->subHours(20)],
            ['status'=>'in_transit', 'location'=>'Heathrow Airport, UK','description'=>'Shipment arrived at Heathrow Airport.',       'event_time'=>now()->subHours(5)],
            ['status'=>'in_transit', 'location'=>'London Hub, UK',      'description'=>'Cleared customs. In transit to delivery hub.','event_time'=>now()->subHours(2)],
        ];

        foreach ($events as $e) {
            TrackingEvent::create(array_merge(['shipment_id' => $shipment->id], $e));
        }
    }
}
