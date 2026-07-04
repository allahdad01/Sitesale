<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Service;

App::boot();

$defaults = [
    [
        'title'       => 'Umrah Packages',
        'tag'         => 'UMRAH',
        'description' => 'Affordable and luxury Umrah packages with hotel, transport, and guided tours &mdash; all included for a blessed journey.',
        'image'       => 'https://images.unsplash.com/photo-1591604129939-f1efa4d9f7fa?w=1600&q=80',
        'link'        => '/contact',
    ],
    [
        'title'       => 'Hajj Packages',
        'tag'         => 'HAJJ',
        'description' => 'Comprehensive Hajj arrangements with experienced guides, premium hotels close to Haram, and full support throughout.',
        'image'       => 'https://images.unsplash.com/photo-1564769625905-50e93615e769?w=1600&q=80',
        'link'        => '/contact',
    ],
    [
        'title'       => 'Flight Booking',
        'tag'         => 'FLIGHTS',
        'description' => 'Best fares on domestic and international flights with our airline partnerships including Kam Air and major carriers.',
        'image'       => 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?w=1600&q=80',
        'link'        => '/contact',
    ],
    [
        'title'       => 'Visa Services',
        'tag'         => 'VISA',
        'description' => 'Hassle-free visa processing for multiple destinations with expert documentation support and fast turnaround.',
        'image'       => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1600&q=80',
        'link'        => '/contact',
    ],
    [
        'title'       => 'Hotel Reservations',
        'tag'         => 'HOTELS',
        'description' => 'Curated hotel bookings from budget-friendly to luxury stays, carefully selected for comfort and proximity.',
        'image'       => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=1600&q=80',
        'link'        => '/contact',
    ],
    [
        'title'       => 'Custom Tours',
        'tag'         => 'TOURS',
        'description' => 'Tailor-made travel experiences designed around your preferences, group size, and budget &mdash; anywhere in the world.',
        'image'       => 'https://images.unsplash.com/photo-1530789253388-582c4b6e0fc0?w=1600&q=80',
        'link'        => '/contact',
    ],
];

$existing = Service::allAdmin();
if (count($existing) > 0) {
    echo "Services already exist. Skipping seed.\n";
} else {
    foreach ($defaults as $i => $d) {
        Service::create([
            'title'       => $d['title'],
            'tag'         => $d['tag'],
            'description' => $d['description'],
            'image'       => $d['image'],
            'link'        => $d['link'],
            'sort_order'  => $i,
            'active'      => 1,
        ]);
        echo "Created service: {$d['title']}\n";
    }
}

echo "Done.\n";
