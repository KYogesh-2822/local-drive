<?php

return [
    /*
    | Existing public URLs that are not managed by the content manager.
    | Managed pages and published blogs are added automatically by the
    | sitemap controller and therefore must not be duplicated here.
    */
    'static_paths' => [
        '/',
        '/careers',
        '/faq',
        '/international-car-rental-locations',
        '/reservation',
        '/view-modify-cancel',
        '/deals-promotions',
        '/car',
        '/suvs',
        '/trucks',
        '/vans',
        '/jordan-car-rental-locations',
        '/business-car-rental',
        '/about',
        '/meet-our-people',
        '/road-trips',
        '/contact',
        '/site-map',
        '/all-vechicles',
        '/our-standard-care',
        '/pursuits-with-enterprise',
        '/terms-of-use',
        '/privacy-policy',
        '/cookie-policy',
        '/terms-conditions',
        '/one-way-car-rental',
        '/long-term-car-rental',
        '/business-rental-form',
        '/career-form',
    ],

    'faq_question_ids' => range(1, 35),

    'vehicle_ids' => range(1, 24),
];
