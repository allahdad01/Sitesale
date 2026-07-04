<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Testimonial;

App::boot();

$defaults = [
    [
        'name'     => 'Ahmad',
        'position' => 'FLIGHT',
        'content'  => 'Booked my emergency flight in minutes. Everything was instant.',
        'rating'   => 5,
    ],
    [
        'name'     => 'Sara',
        'position' => 'HOTEL',
        'content'  => 'Got a luxury upgrade without even asking. Amazing experience.',
        'rating'   => 5,
    ],
    [
        'name'     => 'Omar',
        'position' => 'VISA',
        'content'  => 'Visa process was smooth and fully guided.',
        'rating'   => 5,
    ],
    [
        'name'     => 'Ali',
        'position' => 'SUPPORT',
        'content'  => '24/7 support actually responded in seconds.',
        'rating'   => 5,
    ],
];

$existing = Testimonial::all();
if (count($existing) > 0) {
    echo "Testimonials already exist. Skipping seed.\n";
} else {
    foreach ($defaults as $i => $t) {
        Testimonial::create([
            'name'       => $t['name'],
            'position'   => $t['position'],
            'content'    => $t['content'],
            'rating'     => $t['rating'],
            'sort_order' => $i,
            'active'     => 1,
        ]);
        echo "Created testimonial: {$t['name']}\n";
    }
}

echo "Done.\n";
