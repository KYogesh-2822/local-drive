<?php

namespace Database\Seeders;

use App\Models\Content\BlogCategory;
use App\Models\Content\BlogPost;
use App\Models\Content\ContentPage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContentManagementSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {
            $category = BlogCategory::firstOrCreate(
                ['slug' => 'travel-guides'],
                ['name' => 'Travel Guides', 'is_active' => true]
            );

            $posts = $this->seedBlogs($category);

            foreach ($this->pages() as $pageData) {
                $sections = $pageData['sections'];
                $faqs = $pageData['faqs'];
                unset($pageData['sections'], $pageData['faqs']);

                $page = ContentPage::firstOrCreate(['slug' => $pageData['slug']], $pageData);

                foreach ($sections as $order => $sectionData) {
                    $items = $sectionData['items'] ?? [];
                    unset($sectionData['items']);
                    $section = $page->sections()->firstOrCreate(
                        ['section_key' => $sectionData['section_key']],
                        $sectionData + ['sort_order' => $order, 'is_enabled' => true]
                    );

                    if ($section->items()->doesntExist()) {
                        foreach ($items as $itemOrder => $item) {
                            $section->items()->create($item + ['sort_order' => $itemOrder, 'is_enabled' => true]);
                        }
                    }
                }

                if ($page->faqs()->doesntExist()) {
                    foreach ($faqs as $order => $faq) {
                        $page->faqs()->create($faq + ['sort_order' => $order, 'is_active' => true]);
                    }
                }

                foreach ($posts as $order => $post) {
                    $page->blogPosts()->syncWithoutDetaching([$post->id => ['sort_order' => $order]]);
                }
            }
        });
    }

    private function seedBlogs(BlogCategory $category): array
    {
        $posts = [];

        foreach ($this->blogs() as $data) {
            $faqs = $data['faqs'];
            unset($data['faqs']);
            $data['blog_category_id'] = $category->id;
            $post = BlogPost::firstOrCreate(['slug' => $data['slug']], $data);

            if ($post->faqs()->doesntExist()) {
                foreach ($faqs as $order => $faq) {
                    $post->faqs()->create($faq + ['sort_order' => $order, 'is_active' => true]);
                }
            }
            $posts[] = $post;
        }

        return $posts;
    }

    private function pages(): array
    {
        return [
            $this->homePage(),
            $this->aqabaAirportPage(),
            $this->ammanAirportPage(),
            $this->ammanPage(),
            $this->aqabaPage(),
        ];
    }

    private function homePage(): array
    {
        return [
            'name' => 'Homepage',
            'slug' => 'home',
            'template' => 'home',
            'status' => 'published',
            'hero_image' => 'images/12323232323.jpg',
            'hero_image_alt' => 'Enterprise Rent-A-Car in Jordan',
            'meta_title' => 'Car Rental Jordan | Best Car Hire & Airport Car Rentals',
            'meta_description' => 'Enterprise offers reliable car rental in Jordan with economy, family, SUV and premium vehicles, convenient airport pickup and flexible booking.',
            'focus_keyword' => 'car rental in Jordan',
            'canonical_url' => 'https://enterprise.jo/',
            'published_at' => now(),
            'sections' => [
                [
                    'section_key' => 'hero',
                    'heading' => 'Best Car Rental in Jordan for Airport and City Travel',
                    'subheading' => 'Reserve your vehicle with Enterprise Rent-A-Car Jordan',
                    'body_html' => '<p>Choose your pickup location and dates to begin a secure reservation.</p>',
                ],
                [
                    'section_key' => 'introduction',
                    'heading' => 'Your Trusted Choice for Car Rental in Jordan',
                    'body_html' => '<p>Enterprise Rent-A-Car delivers reliable car rental solutions for travellers who want comfort, flexibility and convenience across every journey. Whether you are arriving for business, leisure or a family trip, our service supports a smooth experience from booking through vehicle return.</p>',
                    'settings' => ['button_label' => 'Contact Us', 'button_url' => '/contact'],
                ],
                [
                    'section_key' => 'why_choose_us',
                    'heading' => 'Why Choose Enterprise Rent-A-Car?',
                    'body_html' => '<p>We combine dependable vehicles, clear rental terms and flexible options for travel across Jordan.</p>',
                    'items' => [
                        ['title' => 'Wide Vehicle Selection', 'body' => '<p>Choose from economy cars, family vehicles, SUVs, vans and premium options for every type of journey.</p>'],
                        ['title' => 'Transparent Pricing', 'body' => '<p>Clear, upfront rates make it easier to compare options and plan your travel budget confidently.</p>'],
                        ['title' => 'Flexible Rental Options', 'body' => '<p>Daily, weekly and long-term plans provide flexibility for holidays, business trips and extended stays.</p>'],
                    ],
                ],
                [
                    'section_key' => 'fleet',
                    'heading' => 'Meet the Fleet',
                    'subheading' => "From SUVs to compact cars, we've got your perfect ride",
                    'layout' => 'fleet-cards',
                    'items' => [
                        ['title' => 'Mini', 'body' => '<p>Ideal for solo travelers with excellent fuel efficiency</p>'],
                        ['title' => 'Economy', 'body' => '<p>Affordable and reliable for city exploration</p>'],
                        ['title' => 'Compact', 'body' => '<p>Perfect balance of comfort and efficiency</p>'],
                        ['title' => 'Intermediate', 'body' => '<p>Extra space for small families and groups</p>'],
                        ['title' => 'Standard', 'body' => '<p>Premium comfort for long-distance journeys</p>'],
                        ['title' => 'View the Complete Fleet', 'button_label' => 'View All Vehicles', 'button_url' => '/all-vechicles'],
                    ],
                ],
                [
                    'section_key' => 'destinations',
                    'heading' => 'Explore Jordan with Freedom',
                    'subheading' => 'Design your itinerary and explore at your own pace',
                    'layout' => 'destination-grid',
                    'items' => [
                        ['title' => 'Petra', 'body' => '<p>The ancient rose-red city carved into cliffs, one of the New Seven Wonders of the World and a UNESCO World Heritage Site</p>'],
                        ['title' => 'The Dead Sea', 'body' => '<p>Known for its unique floating experience and mineral-rich waters. The lowest point on Earth offers therapeutic healing benefits</p>'],
                        ['title' => 'Wadi Rum', 'body' => '<p>A stunning desert landscape famous for its red sand and dramatic cliffs. Perfect for adventure seekers and nature lovers</p>'],
                        ['title' => 'Jerash', 'body' => '<p>One of the best-preserved Roman cities outside Italy with incredible history. A must-visit for archaeology enthusiasts</p>'],
                    ],
                ],
                [
                    'section_key' => 'safety',
                    'heading' => 'Safety & Maintenance Standards',
                    'subheading' => 'Rigorous inspections ensure your safety on every journey',
                    'layout' => 'safety-list',
                    'items' => [
                        ['title' => 'Regular servicing and mechanical inspections before every rental'],
                        ['title' => 'Thorough cleaning and sanitisation for every vehicle'],
                        ['title' => 'Brake, tyre, and engine performance checks for optimal safety'],
                        ['title' => 'Continuous fleet monitoring to ensure road readiness and reliability'],
                        ['title' => 'Replacement of vehicles that do not meet our safety standards'],
                    ],
                ],
                [
                    'section_key' => 'booking_process',
                    'heading' => 'Our Easy Booking Process',
                    'subheading' => 'Simple steps to secure your vehicle in minutes',
                    'layout' => 'booking-process',
                    'items' => [
                        ['title' => 'Select Vehicle', 'body' => '<p>Browse our fleet and choose a vehicle that matches your needs and budget</p>'],
                        ['title' => 'Choose Dates', 'body' => '<p>Select your pick-up location and rental dates for your trip</p>'],
                        ['title' => 'Confirm Booking', 'body' => '<p>Complete your reservation through our secure booking system</p>'],
                        ['title' => 'Collect & Drive', 'body' => '<p>Pick up your vehicle and begin your journey with confidence</p>'],
                    ],
                ],
                ['section_key' => 'blogs', 'heading' => 'Jordan Car Rental Travel Guides', 'body_html' => '<p>Plan your journey with practical advice from Enterprise Rent-A-Car Jordan.</p>'],
                [
                    'section_key' => 'cta',
                    'heading' => 'Book Your Car Rental Today',
                    'body_html' => '<p>Choose a compact city car, family SUV or premium vehicle and enjoy a convenient rental experience from the moment you arrive.</p>',
                    'items' => [['title' => 'Start your reservation', 'button_label' => 'Book Now', 'button_url' => '/reservation']],
                ],
            ],
            'faqs' => [
                ['question' => 'What is included in a rental car booking?', 'answer' => '<p>Your booking includes a maintained vehicle for the selected rental period and access to customer support. Exact inclusions depend on the rate and protection options selected.</p>'],
                ['question' => 'What should I look for when choosing a rental car?', 'answer' => '<p>Consider passenger comfort, fuel efficiency, luggage space, planned distance and the road conditions on your itinerary.</p>'],
                ['question' => 'What should I know before booking a car rental?', 'answer' => '<p>Check the vehicle category, rental duration, pickup location, required documents, payment terms and selected protection products before confirming.</p>'],
                ['question' => 'What documents are required for car rental?', 'answer' => '<p>You will generally need a valid driving licence, passport or accepted identification, and an approved payment method. Requirements can vary by renter and vehicle.</p>'],
                ['question' => 'Can tourists rent a car without local driving experience?', 'answer' => '<p>Yes. Many visitors choose self-drive travel in Jordan. Review local road rules and ask the rental team for guidance before departure.</p>'],
            ],
        ];
    }

    private function aqabaAirportPage(): array
    {
        return $this->locationPage([
            'name' => 'Aqaba Airport',
            'slug' => 'car-rental-aqaba-airport',
            'title' => 'Car Rental at Aqaba Airport',
            'subtitle' => 'Rental Cars in Aqaba',
            'intro' => 'Arriving in Aqaba and looking for dependable transport ready for immediate use? Enterprise Rent-A-Car at Aqaba Airport provides a convenient way to begin your journey as soon as you land in Jordan’s coastal city.',
            'focus' => 'car rental at Aqaba airport',
            'meta' => 'Car Rental at Aqaba Airport | Enterprise Jordan',
            'description' => 'Book car rental at Aqaba Airport with Enterprise Jordan. Choose reliable economy cars, SUVs, family vehicles and flexible rental options.',
            'highlights_key' => 'destinations',
            'highlights_heading' => 'Explore Aqaba and Surroundings with Ease',
            'highlights' => ['Aqaba Corniche', 'Aqaba Marine Park', 'Wadi Rum Desert', 'Petra', 'Dead Sea', 'Tala Bay', 'Downtown Aqaba', 'South Beach Aqaba'],
            'requirements' => '<p>Bring a valid driving licence, a valid passport and an accepted payment method. Age, licence and protection requirements may vary by vehicle and renter, so confirm the current terms before arrival.</p>',
            'cta_heading' => 'Book Your Enterprise Car Rental at Aqaba Airport Today',
            'cta_body' => 'Reserve online, choose from a wide selection and collect your vehicle when you arrive for business, leisure or a desert adventure.',
            'faqs' => [
                ['question' => 'How does Aqaba Airport car rental benefit tourists?', 'answer' => '<p>It provides direct access to private transportation after arrival and makes it easier to reach hotels, beaches and southern Jordan attractions on your own schedule.</p>'],
                ['question' => 'Is car rental at Aqaba Airport available for short stays?', 'answer' => '<p>Yes. Daily and weekly options can suit weekend trips, short holidays and business visits, subject to vehicle availability.</p>'],
                ['question' => 'Are rental cars suitable for families?', 'answer' => '<p>Yes. Families can choose spacious SUVs and multi-passenger vehicles with room for passengers and luggage.</p>'],
                ['question' => 'How early should I book car hire at Aqaba Airport?', 'answer' => '<p>Advance booking is recommended during holidays and busy travel seasons to improve vehicle choice and speed up pickup.</p>'],
                ['question' => 'Can I modify my Aqaba Airport booking?', 'answer' => '<p>Changes to dates or vehicle category may be possible subject to availability and the terms of the reservation.</p>'],
            ],
        ]);
    }

    private function ammanAirportPage(): array
    {
        return $this->locationPage([
            'name' => 'Amman Airport',
            'slug' => 'car-rental-amman-airport',
            'title' => 'Car Rental at Amman Airport',
            'subtitle' => 'Rental Cars at Queen Alia International Airport',
            'intro' => 'Landing in Amman and need a reliable vehicle waiting for you? Enterprise offers a convenient way to start exploring Jordan from Queen Alia International Airport, whether you are arriving for business or a family holiday.',
            'focus' => 'car rental at Amman airport',
            'meta' => 'Car Rental at Amman Airport | Enterprise Jordan',
            'description' => 'Reserve a car at Amman Airport with Enterprise Jordan. Find economy cars, SUVs, family vehicles and flexible pickup at Queen Alia Airport.',
            'highlights_key' => 'destinations',
            'highlights_heading' => 'Explore Amman and Beyond with Confidence',
            'highlights' => ['Downtown Amman', 'The Citadel', 'Rainbow Street', 'The Dead Sea', 'Petra', 'Wadi Rum', 'Jerash', 'Aqaba'],
            'requirements' => '<p>Bring a valid driving licence, a valid passport and an accepted payment method. Eligibility, age and licence requirements can vary, so review the confirmed rental terms before travelling.</p>',
            'cta_heading' => 'Book Your Amman Airport Car Rental Today',
            'cta_body' => 'Start your reservation online, select the vehicle that suits your trip and collect it after arriving at Queen Alia International Airport.',
            'faqs' => [
                ['question' => 'Is car hire at Amman Airport suitable for business travellers?', 'answer' => '<p>Yes. A rental vehicle can provide dependable transport between the airport, hotels, offices and meetings throughout the city.</p>'],
                ['question' => 'Can I return my rental car to a different location?', 'answer' => '<p>One-way rentals may be available for selected routes. Contact the Enterprise team to confirm availability and any applicable charge.</p>'],
                ['question' => 'Where can I collect my vehicle at Queen Alia Airport?', 'answer' => '<p>Your reservation confirmation provides the current collection instructions. Follow airport signs or contact the branch team when you arrive.</p>'],
                ['question' => 'How can I choose the right rental car in Amman?', 'answer' => '<p>Consider passenger count, luggage, driving preferences, travel distance and planned destinations before selecting a category.</p>'],
                ['question' => 'Who can benefit from car hire at Amman Airport?', 'answer' => '<p>It is suitable for tourists, families, professionals and solo travellers who want flexible access to Amman and destinations across Jordan.</p>'],
            ],
        ]);
    }

    private function ammanPage(): array
    {
        return $this->locationPage([
            'name' => 'Amman',
            'slug' => 'car-rental-amman',
            'title' => 'Car Hire in Amman, Jordan',
            'subtitle' => 'Affordable Car Rental in Amman',
            'intro' => 'Enterprise Rent-A-Car makes it simple to find the right vehicle for a business trip, city break or road trip beginning in Jordan’s capital. Choose a convenient office and a vehicle suited to your plans.',
            'focus' => 'car rental in Amman, Jordan',
            'meta' => 'Car Rental in Amman, Jordan | Enterprise',
            'description' => 'Find reliable car rental in Amman with Enterprise Jordan. Compare economy, family, SUV and premium vehicles with flexible rental periods.',
            'highlights_key' => 'rental_offices',
            'highlights_heading' => 'Our Car Rental Offices in Amman',
            'highlights' => ['Queen Alia International Airport', 'Amman City Mall', 'Amman Ash Shumaysani', 'Al Sweifieh'],
            'requirements' => '<p>Bring a valid driving licence accepted for use in Jordan, a passport or approved identification, and an accepted payment method. Confirm the age and licence terms for your selected vehicle before collection.</p>',
            'cta_heading' => 'Ready to Explore Amman with Complete Freedom?',
            'cta_body' => 'Book with Enterprise Rent-A-Car and enjoy transparent pricing, flexible options and a convenient collection process.',
            'faqs' => [
                ['question' => 'Can I find affordable car hire in Amman?', 'answer' => '<p>Yes. Economy and compact categories provide practical options for city travel while maintaining Enterprise vehicle and service standards.</p>'],
                ['question' => 'Is premium car rental available in Amman?', 'answer' => '<p>Premium vehicles may be available for business travel, special occasions and customers seeking additional comfort.</p>'],
                ['question' => 'Can I rent a car in Amman for one day?', 'answer' => '<p>Daily rentals are available for short trips, subject to branch hours, vehicle availability and the selected rate terms.</p>'],
                ['question' => 'What is included in a daily car rental?', 'answer' => '<p>Inclusions depend on the chosen rate, vehicle and protection products. Review your quote and reservation confirmation for exact details.</p>'],
                ['question' => 'Is car rental suitable for first-time visitors?', 'answer' => '<p>Yes. A rental car offers schedule flexibility, and the branch team can explain the vehicle and rental terms before departure.</p>'],
            ],
        ]);
    }

    private function aqabaPage(): array
    {
        return $this->locationPage([
            'name' => 'Aqaba',
            'slug' => 'car-rental-aqaba',
            'title' => 'Affordable Car Rental in Aqaba, Jordan',
            'subtitle' => 'Reliable Car Hire for Jordan’s Red Sea Coast',
            'intro' => 'A car rental in Aqaba gives you the freedom to enjoy the Red Sea coastline, visit nearby Wadi Rum and follow the historic route to Petra at your own pace.',
            'focus' => 'car rental in Aqaba',
            'meta' => 'Car Rental in Aqaba, Jordan | Enterprise',
            'description' => 'Book dependable car rental in Aqaba with Enterprise Jordan. Choose economy cars, SUVs and family vehicles for coastal and regional travel.',
            'highlights_key' => 'rental_offices',
            'highlights_heading' => 'Our Car Rental Offices in Aqaba',
            'highlights' => ['King Hussein International Airport', 'Aqaba City Centre', 'Aqaba Corniche Area'],
            'requirements' => '<p>Bring a valid driving licence accepted for use in Jordan, a valid passport or approved identification, and an accepted payment method. Confirm the eligibility terms for your vehicle category before pickup.</p>',
            'cta_heading' => 'Ready to Explore Aqaba?',
            'cta_body' => 'Reserve your vehicle and enjoy professional support, flexible rental plans and dependable transport for business, leisure or a family holiday.',
            'faqs' => [
                ['question' => 'Can I rent a car for a business trip?', 'answer' => '<p>Yes. A rental vehicle can help professionals travel between meetings, clients, hotels and regional destinations on a flexible schedule.</p>'],
                ['question' => 'Is it easy to rent a car for weekend travel?', 'answer' => '<p>Yes. Daily and weekend rentals can make it convenient to visit beaches, resorts and nearby attractions.</p>'],
                ['question' => 'How far in advance should I book car rental in Aqaba?', 'answer' => '<p>Advance booking is recommended during holidays and peak seasons to secure a wider choice of vehicles.</p>'],
                ['question' => 'Can I extend my rental after collecting the vehicle?', 'answer' => '<p>An extension may be possible subject to availability. Contact the branch before the scheduled return time for approval.</p>'],
                ['question' => 'What should I consider before choosing an Aqaba rental car?', 'answer' => '<p>Consider passenger count, luggage, travel distance, destinations, fuel efficiency and the comfort level you prefer.</p>'],
            ],
        ]);
    }

    private function locationPage(array $data): array
    {
        $fleet = [
            ['title' => 'Economy and Compact Cars', 'body' => '<p>Fuel-efficient, easy to handle and practical for individuals, couples and city driving.</p>'],
            ['title' => 'Intermediate and Standard Cars', 'body' => '<p>Additional comfort and space for small families and business travellers.</p>'],
            ['title' => 'Full-Size and Premium Cars', 'body' => '<p>Extra passenger room, luggage capacity and comfort for longer journeys.</p>'],
            ['title' => 'SUVs and 4x4s', 'body' => '<p>Versatile vehicles suited to city routes and longer travel across Jordan.</p>'],
            ['title' => 'Minivans and MPVs', 'body' => '<p>Generous seating and storage for families and groups travelling together.</p>'],
            ['title' => 'View the Complete Fleet', 'button_label' => 'View All Vehicles', 'button_url' => '/all-vechicles'],
        ];

        $highlights = array_map(
            fn (string $title) => ['title' => $title, 'body' => '<p>Travel comfortably on your own schedule with an Enterprise rental vehicle.</p>'],
            $data['highlights']
        );

        $rentalPhrase = match ($data['slug']) {
            'car-rental-aqaba-airport' => 'Aqaba airport car rental',
            'car-rental-amman-airport' => 'Amman airport car rental',
            'car-rental-amman' => 'car rental in Amman',
            'car-rental-aqaba' => 'car rental in Aqaba',
        };
        $highlightsContent = '<p>With your own vehicle, visiting multiple attractions in one trip becomes simple and convenient.</p>'
            .'<p>Many travellers who choose '.$rentalPhrase.' enjoy the flexibility to explore remote and scenic locations without worrying about transport limitations.</p>';
        $highlightsBefore = match ($data['slug']) {
            'car-rental-aqaba-airport' => '<p>Booking a rental car at Aqaba Airport gives you full freedom to design your itinerary without depending on fixed transport options. You can travel comfortably and explore destinations at your own pace.</p><p>Popular destinations include:</p>',
            'car-rental-amman-airport' => '<p>Booking a rental car at Amman Airport gives you the freedom to plan your route and explore the capital and surrounding destinations at your own pace.</p><p>Popular destinations include:</p>',
            'car-rental-amman' => '<p>Choose a convenient Enterprise location in Amman and collect a vehicle suited to your journey.</p><p>Available rental offices include:</p>',
            'car-rental-aqaba' => '<p>Choose a convenient Enterprise location in Aqaba and collect a vehicle suited to your journey.</p><p>Available rental offices include:</p>',
        };

        $requirementsHeading = 'What You Will Need to Rent a Car';
        $requirementsBody = $data['requirements'];
        $requirementsAfter = null;
        $requirementsItems = [];

        if ($data['slug'] === 'car-rental-aqaba-airport') {
            $requirementsHeading = 'What You’ll Need to Rent a Car at Aqaba Airport, Jordan';
            $requirementsBody = '<p>Driving in Aqaba with a foreign licence is usually straightforward, and an International Driving Permit is not typically required. To complete your booking, you will generally need:</p>';
            $requirementsAfter = '<p>Road conditions in Aqaba are well-maintained, and bilingual road signage in Arabic and English makes navigation simple for international visitors.</p>';
            $requirementsItems = [
                ['title' => 'A valid driving licence'],
                ['title' => 'A valid passport'],
                ['title' => 'Minimum age requirement of around 25 years'],
            ];
        }

        return [
            'name' => $data['name'],
            'slug' => $data['slug'],
            'template' => 'location',
            'status' => 'published',
            'hero_image' => 'images/cars.jpg',
            'hero_image_alt' => $data['title'],
            'meta_title' => $data['meta'],
            'meta_description' => $data['description'],
            'focus_keyword' => $data['focus'],
            'canonical_url' => 'https://enterprise.jo/'.$data['slug'],
            'published_at' => now(),
            'sections' => [
                ['section_key' => 'hero', 'heading' => $data['title'], 'subheading' => $data['subtitle'], 'body_html' => '<p>Reserve online and collect a professionally prepared vehicle from your selected location.</p>'],
                [
                    'section_key' => 'introduction',
                    'heading' => $data['subtitle'],
                    'body_html' => '<p>'.$data['intro'].'</p>',
                    'settings' => ['button_label' => 'Contact Us', 'button_url' => '/contact'],
                ],
                [
                    'section_key' => 'why_choose_us',
                    'heading' => 'Why Choose Enterprise Rent-A-Car?',
                    'body_html' => '<p>Dependable service and a broad vehicle choice help make every rental straightforward.</p>',
                    'items' => [
                        ['title' => 'Modern and Reliable Fleet', 'body' => '<p>Clean, maintained vehicles support comfort, safety and dependable performance.</p>'],
                        ['title' => 'Transparent Pricing', 'body' => '<p>Clear rental rates help you understand the expected cost before confirmation.</p>'],
                        ['title' => 'Flexible Rental Options', 'body' => '<p>Choose daily, weekly or extended rental periods to suit your itinerary.</p>'],
                        ['title' => 'Customer Support', 'body' => '<p>Our team is available to assist with the reservation and rental journey.</p>'],
                    ],
                ],
                [
                    'section_key' => 'fleet',
                    'heading' => 'Choose the Right Car for Your Trip',
                    'subheading' => 'Select a vehicle category based on passenger numbers, luggage, distance and comfort preferences.',
                    'layout' => 'fleet-cards',
                    'items' => $fleet,
                ],
                [
                    'section_key' => 'rental_requirements',
                    'heading' => $requirementsHeading,
                    'subheading' => null,
                    'body_html' => $requirementsBody,
                    'layout' => 'destination-grid',
                    'settings' => $requirementsAfter ? ['after_content' => $requirementsAfter] : null,
                    'items' => $requirementsItems,
                ],
                [
                    'section_key' => $data['highlights_key'],
                    'heading' => $data['highlights_heading'],
                    'subheading' => 'Travel on your own schedule with the freedom to explore the area and nearby destinations.',
                    'body_html' => $highlightsBefore,
                    'layout' => 'safety-list',
                    'settings' => ['after_content' => $highlightsContent],
                    'items' => array_map(fn (array $item) => ['title' => $item['title']], $highlights),
                ],
                [
                    'section_key' => 'booking_process',
                    'heading' => 'Simple Booking Process',
                    'subheading' => 'Reserve your rental vehicle in four straightforward steps.',
                    'layout' => 'booking-process',
                    'items' => [
                        ['title' => 'Select Your Vehicle', 'body' => '<p>Choose a category that fits your travel plans, passengers and luggage.</p>'],
                        ['title' => 'Choose Rental Dates', 'body' => '<p>Select collection and return dates that align with your itinerary.</p>'],
                        ['title' => 'Confirm Your Reservation', 'body' => '<p>Review the rental details and complete the secure reservation.</p>'],
                        ['title' => 'Collect Your Vehicle', 'body' => '<p>Complete the formalities at the branch and begin your journey.</p>'],
                    ],
                ],
                ['section_key' => 'blogs', 'heading' => 'Helpful Jordan Travel Guides', 'body_html' => '<p>Read practical advice before beginning your trip.</p>'],
                ['section_key' => 'cta', 'heading' => $data['cta_heading'], 'body_html' => '<p>'.$data['cta_body'].'</p>', 'items' => [['title' => 'Reserve a vehicle', 'button_label' => 'Book Now', 'button_url' => '/reservation']]],
            ],
            'faqs' => $data['faqs'],
        ];
    }

    private function blogs(): array
    {
        return [
            [
                'title' => 'Complete Guide to Car Rental in Jordan for First-Time Visitors',
                'slug' => 'complete-guide-to-car-rental-in-jordan-for-first-time-visitors',
                'excerpt' => 'Learn about rental requirements, local driving, protection options and practical travel planning for your first self-drive trip in Jordan.',
                'body_html' => $this->firstVisitorBlog(),
                'featured_image' => 'images/content/blogs/complete-guide-to-car-rental-in-jordan-for-first-time-visitors.webp',
                'featured_image_alt' => 'Car rental guide for first-time visitors to Jordan',
                'author_name' => 'Enterprise Rent-A-Car Jordan',
                'status' => 'published',
                'published_at' => now()->subDays(3),
                'meta_title' => 'Car Rental in Jordan: First-Time Visitor Travel Guide',
                'meta_description' => 'Discover everything about car rental in Jordan for first-time visitors, including driving tips, rental requirements and practical travel advice.',
                'focus_keyword' => 'car rental in Jordan',
                'canonical_url' => 'https://enterprise.jo/blog/complete-guide-to-car-rental-in-jordan-for-first-time-visitors',
                'faqs' => [
                    ['question' => 'Can tourists rent a vehicle in Jordan?', 'answer' => '<p>Yes. International visitors can rent vehicles when they meet the provider’s licence, identification, age and payment requirements.</p>'],
                    ['question' => 'Is an international driving permit required?', 'answer' => '<p>Requirements depend on the licence and rental terms. Confirm with the rental branch before travelling.</p>'],
                    ['question' => 'Can I drive between major tourist destinations?', 'answer' => '<p>Many major destinations are connected by road, making a rental vehicle useful for multi-city itineraries.</p>'],
                    ['question' => 'What vehicle is best for first-time visitors?', 'answer' => '<p>Choose based on passenger count, luggage, route, comfort preferences and planned road conditions.</p>'],
                    ['question' => 'Should I purchase vehicle protection?', 'answer' => '<p>Review available protection products, exclusions and any existing coverage before deciding.</p>'],
                ],
            ],
            [
                'title' => 'Is Renting a Car in Jordan Worth It Compared to Public Transport?',
                'slug' => 'is-renting-a-car-in-jordan-worth-it-compared-to-public-transport',
                'excerpt' => 'Compare rental cars and public transportation in Jordan by flexibility, comfort, access and suitability for different itineraries.',
                'body_html' => $this->transportComparisonBlog(),
                'featured_image' => 'images/content/blogs/is-renting-a-car-in-jordan-worth-it-compared-to-public-transport.webp',
                'featured_image_alt' => 'Rental car and public transportation comparison in Jordan',
                'author_name' => 'Enterprise Rent-A-Car Jordan',
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'meta_title' => 'Renting a Car in Jordan vs Public Transport: Full Guide',
                'meta_description' => 'Compare renting a car in Jordan with public transport for convenience, flexibility, comfort and access to popular destinations.',
                'focus_keyword' => 'renting a car in Jordan',
                'canonical_url' => 'https://enterprise.jo/blog/is-renting-a-car-in-jordan-worth-it-compared-to-public-transport',
                'faqs' => [
                    ['question' => 'Is driving in Jordan difficult for tourists?', 'answer' => '<p>Many visitors drive successfully by planning routes, following road signs and allowing extra time in busy urban areas.</p>'],
                    ['question' => 'Do I need an international driving permit in Jordan?', 'answer' => '<p>Licence requirements vary. Confirm the current requirements with the rental provider before arrival.</p>'],
                    ['question' => 'Can I visit Petra and Wadi Rum in the same trip?', 'answer' => '<p>Yes. A planned road itinerary can include both destinations, with enough time for travel and activities.</p>'],
                    ['question' => 'Is public transportation available between major cities?', 'answer' => '<p>Services exist on selected routes, but frequency and direct access may not suit every itinerary.</p>'],
                    ['question' => 'What is the best transportation option for families?', 'answer' => '<p>A rental car often provides additional privacy, luggage room and schedule flexibility for families.</p>'],
                ],
            ],
            [
                'title' => 'Family Car Rental in Jordan: Best Vehicles for Your Trip',
                'slug' => 'family-car-rental-in-jordan-best-vehicles-for-your-trip',
                'excerpt' => 'Choose a family rental vehicle with the right passenger space, luggage capacity, comfort and safety features for a Jordan road trip.',
                'body_html' => $this->familyVehicleBlog(),
                'featured_image' => 'images/content/blogs/family-car-rental-in-jordan-best-vehicles-for-your-trip.webp',
                'featured_image_alt' => 'Best family rental vehicles for travel in Jordan',
                'author_name' => 'Enterprise Rent-A-Car Jordan',
                'status' => 'published',
                'published_at' => now()->subDay(),
                'meta_title' => 'Car Rental in Jordan: Best Family Vehicles for Travel',
                'meta_description' => 'Discover family-friendly car rental options in Jordan, including spacious vehicles, safety considerations and comfort advice.',
                'focus_keyword' => 'family car rental in Jordan',
                'canonical_url' => 'https://enterprise.jo/blog/family-car-rental-in-jordan-best-vehicles-for-your-trip',
                'faqs' => [
                    ['question' => 'What documents are usually required to rent a vehicle in Jordan?', 'answer' => '<p>Providers generally require a valid driving licence, identification and an accepted payment method. Additional requirements may apply.</p>'],
                    ['question' => 'Is it easy to drive between major tourist destinations?', 'answer' => '<p>Many popular destinations are connected by road. Route planning and regular breaks help make family travel comfortable.</p>'],
                    ['question' => 'Can child seats be requested with rental vehicles?', 'answer' => '<p>Child seats may be available on request. Reserve required equipment early because availability can be limited.</p>'],
                    ['question' => 'Which vehicle is best for long family road trips?', 'answer' => '<p>SUVs and multi-passenger vehicles are popular because they offer passenger space and luggage capacity.</p>'],
                    ['question' => 'Should I reserve a vehicle before arriving in Jordan?', 'answer' => '<p>Advance booking is recommended during busy seasons and when you need a specific family vehicle or child seat.</p>'],
                ],
            ],
        ];
    }

    private function firstVisitorBlog(): string
    {
        return <<<'HTML'
<p>Planning your first trip to Jordan is exciting. Ancient archaeological sites, desert landscapes, vibrant cities and coastal destinations are spread across the country, and a rental vehicle gives you the flexibility to explore them at your own pace. Understanding the rental process before arrival can help you avoid common mistakes and travel with confidence.</p>
<h2>Why Renting a Vehicle Makes Travel Easier in Jordan</h2>
<p>Public transportation works for some journeys, but it may not match the schedule or direct access many visitors need. A rental car can make remote attractions and multi-city itineraries more practical while giving you control over stops and travel time.</p>
<ul><li>Greater travel flexibility</li><li>Access to destinations outside major cities</li><li>More control over daily schedules</li><li>Comfortable luggage storage</li><li>Freedom to stop at scenic locations</li></ul>
<h2>Important Documents to Prepare</h2>
<p>Requirements vary by nationality, age, licence and vehicle category. Commonly requested documents include a valid driving licence, passport or accepted identification, reservation details and an approved payment method. Ask the branch whether any additional licence documentation is needed.</p>
<h2>Understanding Local Driving Conditions</h2>
<p>Major cities and tourist destinations are connected by road, but traffic conditions vary. Urban areas can be busy, rural roads may have different lighting or surfaces, and defensive driving is always recommended. Observe posted speed limits and use a reliable navigation tool.</p>
<h2>Starting with Car Rental at a Jordan Airport</h2>
<p>Airport collection can provide immediate transportation after arrival and reduce the need for a separate transfer. It is particularly convenient for travellers carrying luggage or beginning a multi-destination itinerary.</p>
<h2>Popular Destinations for a Self-Drive Trip</h2>
<p>Amman, Petra, Wadi Rum, the Dead Sea, Aqaba and Jerash are frequently included in driving itineraries. Check distances, opening hours, fuel stops and weather before departure, and avoid trying to fit too many long journeys into one day.</p>
<h2>Comparing Car Rental Services</h2>
<p>Compare the available vehicle categories, rental terms, protection products, customer support, branch locations, pickup and return options and additional-driver conditions. The lowest advertised price may not include the same services or terms as another rate.</p>
<h2>Choosing the Right Vehicle</h2>
<p>Consider passenger numbers, luggage, planned distances, city parking, road conditions and comfort preferences. Economy cars can be practical for cities, while families and groups may prefer an SUV or multi-passenger vehicle.</p>
<h2>Protection and Rental Terms</h2>
<p>Read the agreement and understand the fuel policy, deposit or payment requirements, vehicle inspection process, return conditions, protection products, exclusions and roadside support. Record any existing damage during collection and ask questions before leaving the branch.</p>
<h2>Practical Tips for a Smooth Trip</h2>
<ul><li>Book early during busy travel periods.</li><li>Keep your documents and reservation confirmation accessible.</li><li>Inspect the vehicle before departure.</li><li>Plan fuel and rest stops for longer routes.</li><li>Keep the branch and roadside support details available.</li><li>Allow extra time when driving in unfamiliar areas.</li></ul>
<h2>Common Mistakes to Avoid</h2>
<p>Avoid selecting a vehicle without considering luggage, ignoring the confirmed rate terms, returning late without contacting the branch, or assuming every road and destination is suitable for the selected vehicle. Preparation helps prevent avoidable delays and charges.</p>
<h2>Ready to Explore Jordan?</h2>
<p>Enterprise Rent-A-Car Jordan offers a range of vehicles for city visits, family trips and longer road journeys. <a href="/contact">Contact us</a> if you need help choosing a suitable vehicle, or begin your reservation online.</p>
HTML;
    }

    private function transportComparisonBlog(): string
    {
        return <<<'HTML'
<p>Jordan offers several transportation options, and the best choice depends on your itinerary, budget, group size and preferred level of flexibility. Public transport can suit simple city-to-city travel, while a rental car is often more convenient for travellers visiting several attractions.</p>
<h2>Understanding Transportation Options Across Jordan</h2>
<p>Buses, taxis, ride services, tours and rental vehicles all serve different needs. Availability and frequency vary by location, and some tourist destinations require connections or additional transfers.</p>
<h2>Freedom and Flexibility on Your Schedule</h2>
<p>A rental vehicle allows you to choose departure times, change plans and spend longer at places that interest you. Public transport follows established routes and schedules, which can be useful for straightforward journeys but restrictive for detailed itineraries.</p>
<h2>Convenience for Popular Tourist Destinations</h2>
<p>Petra, Wadi Rum, the Dead Sea, Jerash and Aqaba can be combined into a road itinerary. Direct transportation between every pair of destinations may not always be available, so compare total journey time rather than only the fare.</p>
<h2>Comfort for Families and Groups</h2>
<p>Families often value private space, luggage storage, child-seat availability and the ability to stop when needed. Groups can also compare the total rental cost with multiple tickets, transfers or taxis.</p>
<h2>Access Beyond Major Cities</h2>
<p>Public transport is more available in populated areas. A rental car can provide better access to accommodation, viewpoints, smaller towns and attractions outside established routes.</p>
<h2>What to Expect When You Rent a Car</h2>
<p>You will need to meet the provider’s licence, age, identification and payment requirements. Review the rental duration, fuel terms, mileage conditions, protection products, deposit, branch hours and return instructions before confirming.</p>
<h2>When Public Transportation May Work Well</h2>
<p>Public transport can be a practical option if you are staying mainly in one city, travelling alone with limited luggage, following a simple route or prefer not to drive. Organised tours can also suit visitors who want transportation and a guide together.</p>
<h2>Cost Considerations</h2>
<p>Compare the complete trip cost. For a rental this includes the rate, fuel, parking, optional products and possible one-way charges. For public transport include transfers, taxis between terminals and accommodation, and the value of additional travel time.</p>
<h2>Making the Right Choice</h2>
<p>Choose public transport for simple, schedule-friendly travel. Consider a rental car when flexibility, private space, luggage capacity and access to several destinations are priorities. Some travellers combine both approaches.</p>
<h2>Ready to Explore Jordan Your Way?</h2>
<p>Browse Enterprise vehicle options or <a href="/contact">contact the team</a> for help planning a rental that matches your itinerary.</p>
HTML;
    }

    private function familyVehicleBlog(): string
    {
        return <<<'HTML'
<p>A successful family road trip begins with a vehicle that fits both the passengers and the itinerary. Space, luggage capacity, comfort, safety features and ease of access can affect every day of the journey.</p>
<h2>Why the Right Vehicle Matters for Family Travel</h2>
<p>Jordan itineraries often involve drives between Amman, Petra, Wadi Rum, the Dead Sea and Aqaba. A suitable vehicle helps family members remain comfortable and provides room for luggage, snacks, child equipment and other essentials.</p>
<h2>Spacious SUVs for Family Adventures</h2>
<p>SUVs are popular with families because of elevated seating, flexible luggage space and comfortable cabins. Select the size carefully: a compact SUV may suit a small family, while additional passengers and large luggage may require a larger category.</p>
<h2>Multi-Passenger Vehicles for Larger Groups</h2>
<p>Minivans and other multi-passenger vehicles provide extra seats and practical access for larger families. Check the seating configuration and available cargo space with all seats in use.</p>
<h2>Premium Options for Additional Comfort</h2>
<p>Premium vehicles can offer quieter cabins, upgraded seating and convenience technology for longer drives. They may suit special occasions or travellers who prioritise comfort, but luggage and passenger capacity should still guide the decision.</p>
<h2>Popular Vehicle Categories</h2>
<ul><li>Compact and midsize cars for small families and city-focused trips</li><li>Crossovers for flexible passenger and luggage use</li><li>SUVs for additional room and longer itineraries</li><li>Multi-passenger vehicles for larger groups</li><li>Premium models for an upgraded travel experience</li></ul>
<h2>Features Families Should Prioritise</h2>
<ul><li>Enough seats and seat belts for every passenger</li><li>Luggage space with the required seats in use</li><li>Child-seat compatibility</li><li>Air conditioning and rear passenger comfort</li><li>Driver-assistance and safety features available on the selected model</li><li>Phone connectivity or navigation support</li></ul>
<h2>Best Choices by Family Size</h2>
<p>Small families may find compact SUVs, crossovers or midsize cars sufficient. Medium-sized families often benefit from a larger SUV or spacious saloon. Larger groups should compare multi-passenger categories and confirm both seating and cargo capacity.</p>
<h2>Tips for a Smooth Family Road Trip</h2>
<p>Plan routes and accommodation in advance, keep essential items accessible, pack efficiently and schedule regular breaks. Carry water, snacks and age-appropriate entertainment, and allow extra time rather than building an overly demanding itinerary.</p>
<h2>Comfort and Safety Come First</h2>
<p>The best family vehicle balances comfort, reliability, practicality and cost. Confirm requested equipment before collection and take time to understand the vehicle controls before starting a long journey.</p>
<h2>Start Your Jordan Family Adventure</h2>
<p>Enterprise Rent-A-Car Jordan offers options for different family sizes and travel plans. <a href="/contact">Contact us</a> for help selecting a suitable category or begin your reservation online.</p>
HTML;
    }
}
