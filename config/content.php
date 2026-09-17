<?php

return [
    'managed_pages_live' => env('CONTENT_MANAGED_PAGES_LIVE', false),
    'publishing_timezone' => env('CONTENT_PUBLISHING_TIMEZONE', 'Asia/Amman'),

    'system_pages' => [
        'home' => [
            'name' => 'Homepage',
            'template' => 'home',
            'sections' => [
                'hero', 'introduction', 'why_choose_us', 'fleet', 'destinations',
                'safety', 'booking_process', 'blogs', 'cta',
            ],
        ],
        'car-rental-aqaba-airport' => [
            'name' => 'Aqaba Airport',
            'template' => 'location',
            'sections' => [
                'hero', 'introduction', 'why_choose_us', 'fleet', 'destinations',
                'rental_requirements', 'booking_process', 'blogs', 'cta',
            ],
        ],
        'car-rental-amman-airport' => [
            'name' => 'Amman Airport',
            'template' => 'location',
            'sections' => [
                'hero', 'introduction', 'why_choose_us', 'fleet', 'destinations',
                'rental_requirements', 'booking_process', 'blogs', 'cta',
            ],
        ],
        'car-rental-amman' => [
            'name' => 'Amman',
            'template' => 'location',
            'sections' => [
                'hero', 'introduction', 'why_choose_us', 'fleet', 'rental_offices',
                'rental_requirements', 'booking_process', 'blogs', 'cta',
            ],
        ],
        'car-rental-aqaba' => [
            'name' => 'Aqaba',
            'template' => 'location',
            'sections' => [
                'hero', 'introduction', 'why_choose_us', 'fleet', 'rental_offices',
                'rental_requirements', 'booking_process', 'blogs', 'cta',
            ],
        ],
    ],

    'section_labels' => [
        'hero' => 'Hero / Reservation',
        'introduction' => 'Introduction',
        'why_choose_us' => 'Why Choose Us',
        'fleet' => 'Fleet',
        'destinations' => 'Destinations',
        'rental_offices' => 'Rental Offices',
        'rental_requirements' => 'Rental Requirements',
        'safety' => 'Safety and Maintenance',
        'booking_process' => 'Booking Process',
        'blogs' => 'Selected Blogs',
        'cta' => 'Call to Action',
    ],
];
