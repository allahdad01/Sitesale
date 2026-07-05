<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Setting;

App::boot();

$defaults = [
    'footer_services_heading'     => 'Services',
    'footer_destinations_heading' => 'Destinations',
    'footer_tagline'              => 'Certified Hajj &amp; Umrah Operator',
];

foreach ($defaults as $key => $value) {
    $existing = Setting::get($key);
    if ($existing === null || $existing === '') {
        Setting::set($key, $value);
        echo "Seeded: {$key}\n";
    } else {
        echo "Exists:  {$key}\n";
    }
}

Setting::flushCache();
echo "Done.\n";
