<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Company Profile
    |--------------------------------------------------------------------------
    |
    | Central content for the B.Fern Apparel marketing website. Edit these
    | values to update copy across the site without touching the views.
    |
    */

    'name' => 'B.Fern Apparel',

    'tagline' => 'A Leading Name in Apparel Liquidation',

    'short_description' => 'B.Fern Apparel is one of the largest apparel liquidators in the United States, with over 20 years of experience connecting leading brands with buyers. We are authorized to purchase merchandise overseas for 50 brands, handling men\'s, women\'s, and children\'s knit and woven apparel through an international network of offices.',

    'boilerplate' => 'B.Fern Apparel is a leading U.S. apparel liquidator with 20+ years of experience, authorized relationships with 50 brands, and an international network across Asia, North Africa, and the Middle East, with a showroom at 525 Seventh Avenue, New York.',

    'vice_president_message' => [
        'name' => 'Jeffrey Charen',
        'title' => 'President',
        'photo' => 'images/teams/jeffrey-charen.jpg',
        'heading' => 'Trust, built one shipment at a time',
        'body' => [
            'For more than two decades, our promise has stayed the same: treat every brand, every buyer, and every shipment with the care we would expect for our own business. That commitment is what turns a single transaction into a relationship that lasts for years.',
            'We are proud of the trust our brand partners place in us and of the buyers who rely on our team for quality, consistency, and integrity. As we continue to grow across markets, we remain focused on the details that matter — authorized sourcing, dependable communication, and merchandise that meets expectations.',
            'Thank you for being part of the B.Fern Apparel story. We look forward to what we will build together next.',
        ],
    ],

    'years_of_experience' => '20+',

    'brands_count' => '50',

    'stats' => [
        ['value' => '20+', 'label' => 'Years in the apparel market'],
        ['value' => '50', 'label' => 'Brands under agreement'],
        ['value' => '7', 'label' => 'International offices'],
        ['value' => '3', 'label' => 'U.S. locations'],
    ],

    'product_categories' => [
        'Men\'s Apparel',
        'Women\'s Apparel',
        'Children\'s Apparel',
        'Knit Garments',
        'Woven Garments',
    ],

    /*
    |--------------------------------------------------------------------------
    | Locations
    |--------------------------------------------------------------------------
    */

    'international_offices' => [
        ['country' => 'Vietnam', 'region' => 'Asia'],
        ['country' => 'Indonesia', 'region' => 'Asia'],
        ['country' => 'Cambodia', 'region' => 'Asia'],
        ['country' => 'Bangladesh', 'region' => 'Asia'],
        ['country' => 'Egypt', 'region' => 'North Africa'],
        ['country' => 'Jordan', 'region' => 'Middle East'],
        ['country' => 'Kenya', 'region' => 'Africa'],
    ],

    'us_locations' => [
        [
            'city' => 'New York, NY',
            'type' => 'Showroom',
            'address' => '525 Seventh Avenue',
            'description' => 'Our Manhattan showroom, where buyers review merchandise and meet with our team.',
        ],
        [
            'city' => 'Brooklyn, NY',
            'type' => 'Office',
            'address' => null,
            'description' => 'Supporting day-to-day operations and customer relationships.',
        ],
        [
            'city' => 'Edison, NJ',
            'type' => 'Office & Warehouse',
            'address' => null,
            'description' => 'Offices and warehousing for merchandise handling and logistics.',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Contact
    |--------------------------------------------------------------------------
    |
    | Update these values (or set them in .env) with the live contact
    | details before launch.
    |
    */

    'contact' => [
        'email' => env('B_FERN_CONTACT_EMAIL', 'info@bfernapparel.com'),
        'phone' => env('B_FERN_CONTACT_PHONE'),
        'showroom_address' => '525 Seventh Avenue, New York, NY',
        'subjects' => [
            'buying' => 'Buying merchandise',
            'liquidation' => 'Liquidation & closeouts',
            'brand' => 'Brand partnership',
            'other' => 'General inquiry',
        ],
    ],

    'social' => [
        'linkedin' => env('B_FERN_LINKEDIN_URL'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Access
    |--------------------------------------------------------------------------
    |
    | Credentials used by the admin seeder. Update these (or set them in
    | .env) and re-run: php artisan db:seed --class=AdminUserSeeder
    |
    */

    'admin' => [
        'name' => env('ADMIN_NAME', 'B.Fern Admin'),
        'email' => env('ADMIN_EMAIL', 'admin@bfernapparel.com'),
        'password' => env('ADMIN_PASSWORD', 'password'),
    ],

];
