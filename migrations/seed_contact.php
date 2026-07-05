<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Setting;

App::boot();

$defaults = [
    'contact_hero_badge'    => "We're Here To Help",
    'contact_hero_title'    => 'Let\'s Plan Your<br><span class="orange">Next Journey</span>',
    'contact_hero_subtitle' => 'Whether you need a full Umrah package, a flight ticket, or just some advice — reach out and our team will respond within 24 hours.',
    'contact_sidebar_badge' => 'Get In Touch',
    'contact_sidebar_heading' => "We'd Love to Hear From You",
    'contact_sidebar_text'  => 'Our travel consultants are ready to help plan your perfect journey.',
    'contact_phone'         => '+93 700 000 000',
    'contact_email'         => 'info@almoqadas.com',
    'contact_address'       => 'Kabul, Afghanistan',
    'contact_hours_week'    => '8:00 AM – 6:00 PM',
    'contact_hours_friday'  => 'Closed',
    'contact_form_badge'    => 'Send Us a Message',
    'contact_form_heading'  => 'Request a Package',
    'contact_form_text'     => "Tell us about your travel plans and we'll create a custom quote.",
    'contact_faq_tag'       => 'Common Questions',
    'contact_faq_title'     => 'Frequently Asked Questions',
    'contact_faq_desc'      => 'Quick answers to the most common inquiries we receive.',
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
