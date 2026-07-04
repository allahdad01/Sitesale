<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Award;

App::boot();

$defaults = [
    ['label' => 'Al-Khomri Partnership', 'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=400'],
    ['label' => 'Kam Air Award 2020',     'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=400'],
    ['label' => '20+ Years Serving',      'image' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=400'],
];

$existing = Award::allAdmin();
if (count($existing) > 0) {
    echo "Awards already exist. Skipping seed.\n";
} else {
    foreach ($defaults as $i => $d) {
        Award::create([
            'image'      => $d['image'],
            'label'      => $d['label'],
            'sort_order' => $i,
            'active'     => 1,
        ]);
        echo "Created award: {$d['label']}\n";
    }
}

echo "Done.\n";
