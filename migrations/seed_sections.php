<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\PageSection;

App::boot();

$builtins = [
    ['page' => 'home', 'section_key' => 'hero',         'label' => 'Hero Banner',       'type' => 'builtin', 'active' => 1, 'sort_order' => 0],
    ['page' => 'home', 'section_key' => 'services',     'label' => 'Services',          'type' => 'builtin', 'active' => 1, 'sort_order' => 1],
    ['page' => 'home', 'section_key' => 'packages',     'label' => 'Featured Packages', 'type' => 'builtin', 'active' => 1, 'sort_order' => 2],
    ['page' => 'home', 'section_key' => 'destinations', 'label' => 'Destinations',      'type' => 'builtin', 'active' => 1, 'sort_order' => 3],
    ['page' => 'home', 'section_key' => 'awards',       'label' => 'Awards & Recognition', 'type' => 'builtin', 'active' => 1, 'sort_order' => 4],
    ['page' => 'home', 'section_key' => 'testimonials', 'label' => 'Testimonials',       'type' => 'builtin', 'active' => 1, 'sort_order' => 5],
    ['page' => 'home', 'section_key' => 'blog',         'label' => 'Recent Blog Posts',  'type' => 'builtin', 'active' => 1, 'sort_order' => 6],
    ['page' => 'home', 'section_key' => 'contact',      'label' => 'Contact Form',       'type' => 'builtin', 'active' => 1, 'sort_order' => 6],
];

$existing = PageSection::activeKeys('home');
foreach ($builtins as $b) {
    if (!in_array($b['section_key'], $existing)) {
        PageSection::create($b);
        echo "Created: {$b['label']}\n";
    } else {
        echo "Exists:  {$b['label']}\n";
    }
}
