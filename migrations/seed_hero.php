<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Setting;

App::boot();

$defaults = [
    'hero_badge'      => 'Trusted Since 2010 · Hajj & Umrah Specialists',
    'hero_title'      => 'Your Sacred Journey<br><span class="orange">Begins Here</span>',
    'hero_subtitle'   => 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.',
    'hero_btn1_text'  => 'Explore Packages',
    'hero_btn1_url'   => '#services',
    'hero_btn2_text'  => 'View Destinations',
    'hero_btn2_url'   => '#destinations',
    'hero_stat1_num'  => '20+',
    'hero_stat1_label' => 'Years Experience',
    'hero_stat2_num'  => '50K+',
    'hero_stat2_label' => 'Happy Pilgrims',
    'hero_stat3_num'  => '30+',
    'hero_stat3_label' => 'Destinations',
    'hero_stat4_num'  => '100%',
    'hero_stat4_label' => 'Visa Success',
    'hero_slide1_img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Dubai_Skyline_2016.jpg?width=400',
    'hero_slide1_label' => 'Dubai',
    'hero_slide2_img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Hagia_Sophia_and_Blue_Mosque.jpg?width=400',
    'hero_slide2_label' => 'Istanbul',
    'hero_slide3_img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Kabul_Downtown_(Afghanistan).jpg?width=400',
    'hero_slide3_label' => 'Kabul',
    'hero_slide4_img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/View_on_Petronas_Towers.JPG?width=400',
    'hero_slide4_label' => 'Kuala Lumpur',
    'hero_slide5_img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Al_Masjid_An-Nabawi.jpg?width=400',
    'hero_slide5_label' => 'Medina',
    'hero_slide6_img' => 'https://commons.wikimedia.org/wiki/Special:FilePath/Tower_Bridge.JPG?width=400',
    'hero_slide6_label' => 'London',
    'hero_kaaba_img'  => 'https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=950',
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
