<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Setting;

App::boot();

$defaults = [
    ['key' => 'site_name',           'value' => 'Al Moqadas Travel Agency',       'type' => 'text'],
    ['key' => 'site_tagline',        'value' => 'Your Sacred Journey Begins Here', 'type' => 'text'],
    ['key' => 'logo_text',           'value' => 'Al Moqadas',                      'type' => 'text'],
    ['key' => 'logo_icon',           'value' => 'fa-mosque',                       'type' => 'text'],
    ['key' => 'logo_image',          'value' => '',                                'type' => 'image'],
    ['key' => 'favicon',             'value' => '',                                'type' => 'image'],
    ['key' => 'color_primary',       'value' => '#FE590B',                         'type' => 'color'],
    ['key' => 'color_primary_dark',  'value' => '#d44500',                         'type' => 'color'],
    ['key' => 'color_primary_light', 'value' => '#ff7a38',                         'type' => 'color'],
    ['key' => 'color_navy',          'value' => '#2A2A68',                         'type' => 'color'],
    ['key' => 'color_navy_dark',     'value' => '#1e1e50',                         'type' => 'color'],
    ['key' => 'color_navy_light',    'value' => '#38388a',                         'type' => 'color'],
    ['key' => 'color_bg',            'value' => '#D3D3D3',                         'type' => 'color'],
    ['key' => 'color_bg2',           'value' => '#bebebe',                         'type' => 'color'],
    ['key' => 'contact_phone',       'value' => '+93 700 000 000',                 'type' => 'text'],
    ['key' => 'contact_email',       'value' => 'info@almoqadas.com',              'type' => 'text'],
    ['key' => 'contact_address',     'value' => 'Kabul, Afghanistan',              'type' => 'text'],
    ['key' => 'whatsapp_number',     'value' => '93700000000',                     'type' => 'text'],
    ['key' => 'social_facebook',     'value' => '#',                               'type' => 'text'],
    ['key' => 'social_twitter',      'value' => '#',                               'type' => 'text'],
    ['key' => 'social_linkedin',     'value' => '#',                               'type' => 'text'],
    ['key' => 'social_instagram',    'value' => '',                                'type' => 'text'],
    ['key' => 'hero_title',          'value' => 'Your Sacred Journey<br><span class="orange">Begins Here</span>', 'type' => 'textarea'],
    ['key' => 'hero_subtitle',       'value' => 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.', 'type' => 'textarea'],
    ['key' => 'footer_description',  'value' => 'Your trusted partner for Hajj, Umrah, and worldwide travel since 2010. Serving pilgrims and travelers with care, integrity, and excellence.', 'type' => 'textarea'],
    ['key' => 'footer_copyright',    'value' => 'Al Moqadas Travel Agency',         'type' => 'text'],
    ['key' => 'meta_description',    'value' => 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.', 'type' => 'textarea'],
    ['key' => 'meta_keywords',       'value' => 'Hajj, Umrah, travel agency, flights, visa, Afghanistan', 'type' => 'text'],
    ['key' => 'google_analytics_id', 'value' => '',                                'type' => 'text'],
];

Setting::setMultiple($defaults);

echo "Default settings seeded: " . count($defaults) . " values\n";
