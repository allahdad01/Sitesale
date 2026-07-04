<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\HeroSlide;

App::boot();

$defaults = [
    ['label' => 'Dubai',       'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=400'],
    ['label' => 'Istanbul',    'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=400'],
    ['label' => 'Kabul',       'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Kabul_Downtown_(Afghanistan).jpg?width=400'],
    ['label' => 'Kuala Lumpur','image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/View_on_Petronas_Towers.JPG?width=400'],
    ['label' => 'Medina',      'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Al_Masjid_An-Nabawi.jpg?width=400'],
    ['label' => 'London',      'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Tower_Bridge.JPG?width=400'],
];

$existing = HeroSlide::allAdmin();
if (count($existing) > 0) {
    echo "Slides already exist. Skipping seed.\n";
} else {
    foreach ($defaults as $i => $d) {
        HeroSlide::create([
            'image'      => $d['image'],
            'label'      => $d['label'],
            'sort_order' => $i,
            'active'     => 1,
        ]);
        echo "Created slide: {$d['label']}\n";
    }
}

echo "Done.\n";
