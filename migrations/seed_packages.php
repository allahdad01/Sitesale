<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Package;

App::boot();

$packages = [
    [
        'title' => '7-Day Premium Umrah Package',
        'description' => '<h3>Experience a Blessed Umrah Journey</h3><p>Our premium Umrah package includes 5-star accommodation near the Haram in both Makkah and Madinah, private transport, and a dedicated guide throughout your stay.</p><ul><li>Return flights from Kabul</li><li>Visa processing included</li><li>5 nights in Makkah (5-star)</li><li>3 nights in Madinah (5-star)</li><li>Daily breakfast and dinner</li><li>Private guide and transporter</li></ul>',
        'price' => 2499.00,
        'duration_days' => 7,
        'max_people' => 10,
        'category' => 'umrah',
        'destination' => 'Saudi Arabia',
        'featured' => 1,
        'active' => 1,
    ],
    [
        'title' => '12-Day Hajj Package',
        'description' => '<h3>Complete Hajj Experience</h3><p>Our comprehensive Hajj package covers every aspect of your pilgrimage with premium services and experienced guides.</p><ul><li>Return flights</li><li>Visa processing</li><li>Accommodation in Mina, Arafat, Muzdalifah</li><li>Experienced Hajj guide</li><li>Transportation throughout</li><li>Meals included</li></ul>',
        'price' => 5999.00,
        'duration_days' => 12,
        'max_people' => 15,
        'category' => 'hajj',
        'destination' => 'Saudi Arabia',
        'featured' => 1,
        'active' => 1,
    ],
    [
        'title' => '5-Day Dubai Family Tour',
        'description' => '<h3>Explore the City of Gold</h3><p>A family-friendly Dubai package featuring top attractions, shopping, and desert adventures.</p><ul><li>Return flights</li><li>4-star hotel with breakfast</li><li>Desert safari</li><li>Burj Khalifa visit</li><li>City tour</li><li>Transfers</li></ul>',
        'price' => 1299.00,
        'duration_days' => 5,
        'max_people' => 8,
        'category' => 'tour',
        'destination' => 'Dubai',
        'featured' => 1,
        'active' => 1,
    ],
    [
        'title' => 'Visa Processing Service',
        'description' => '<p>Hassle-free visa processing for Saudi Arabia, UAE, Turkey, and more. We handle all documentation and submission.</p><ul><li>Document review</li><li>Application submission</li><li>Tracking updates</li><li>Fast processing</li></ul>',
        'price' => 299.00,
        'duration_days' => 1,
        'max_people' => 1,
        'category' => 'visa',
        'destination' => 'Multiple',
        'featured' => 0,
        'active' => 1,
    ],
    [
        'title' => 'Istanbul Cultural Tour',
        'description' => '<h3>Discover the Crossroads of Civilizations</h3><p>Explore Istanbul\'s rich history with guided tours of Hagia Sophia, Blue Mosque, Topkapi Palace, and the Grand Bazaar.</p><ul><li>Return flights</li><li>4-star hotel</li><li>Professional guide</li><li>Entrance fees</li><li>Daily breakfast</li></ul>',
        'price' => 1599.00,
        'duration_days' => 6,
        'max_people' => 12,
        'category' => 'tour',
        'destination' => 'Turkey',
        'featured' => 0,
        'active' => 1,
    ],
];

foreach ($packages as $p) {
    $slug = Package::slugify($p['title']);
    $existing = Package::findBySlug($slug);
    if ($existing) {
        echo "Exists: {$p['title']}\n";
        continue;
    }
    $p['slug'] = $slug;
    Package::create($p);
    echo "Created: {$p['title']}\n";
}

echo "Done.\n";
