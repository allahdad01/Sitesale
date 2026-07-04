<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Post;

App::boot();

$posts = [
    [
        'title' => 'A Complete Guide to Performing Umrah',
        'featured' => 1,
        'excerpt' => 'Everything you need to know about your Umrah journey — from visa requirements to step-by-step rituals.',
        'content' => '<h3>Introduction</h3><p>Performing Umrah is a deeply spiritual experience that every Muslim aspires to undertake. This guide covers everything from preparation to completion.</p><h3>Step 1: Visa Requirements</h3><p>Ensure your passport is valid for at least 6 months. Contact Al Moqadas to process your Umrah visa quickly and hassle-free.</p><h3>Step 2: Booking Your Package</h3><p>Choose from our range of Umrah packages tailored to every budget. We handle flights, hotels, and transport so you can focus on worship.</p><h3>Step 3: Ihram</h3><p>Put on Ihram before entering the Miqat. Men wear two white seamless cloths; women wear modest clothing.</p><h3>Step 4: Tawaf</h3><p>Circumambulate the Kaaba seven times counterclockwise, reciting prayers and supplications.</p><h3>Step 5: Sa\'i</h3><p>Walk seven times between Safa and Marwa, commemorating Hajar\'s search for water.</p><h3>Step 6: Shaving/Trimming Hair</h3><p>Men shave their heads or trim; women cut a fingertip length of hair.</p><h3>Conclusion</h3><p>May your Umrah be accepted. Al Moqadas Travel is honored to serve you on this blessed journey.</p>',
        'author' => 'Al Moqadas Team',
        'category' => 'guide',
        'active' => 1,
    ],
    [
        'title' => 'Top 10 Travel Destinations for Muslim Travelers in 2026',
        'excerpt' => 'Discover the best halal-friendly destinations around the world for your next vacation.',
        'content' => '<h3>1. Saudi Arabia</h3><p>The heart of the Islamic world, home to Makkah and Madinah. Also explore the Red Sea coast and modern Riyadh.</p><h3>2. Turkey</h3><p>Istanbul, Cappadocia, and the Turkish Riviera offer amazing halal-friendly experiences with rich Islamic history.</p><h3>3. Malaysia</h3><p>Halal food paradise with stunning beaches, rainforests, and modern cities like Kuala Lumpur.</p><h3>4. UAE</h3><p>Dubai and Abu Dhabi offer luxury travel with excellent halal dining and family-friendly attractions.</p><h3>5. Maldives</h3><p>Private resort islands with halal food and prayer facilities — the perfect romantic getaway.</p><h3>6. Morocco</h3><p>Rich Islamic heritage, vibrant souks, and beautiful architecture in Marrakech and Fes.</p><h3>7. Indonesia</h3><p>The world\'s largest Muslim population — Bali, Jakarta, and Yogyakarta with incredible cultural experiences.</p><h3>8. Uzbekistan</h3><p>Ancient Silk Road cities like Samarkand and Bukhara with stunning Islamic architecture.</p><h3>9. Jordan</h3><p>Petra, the Dead Sea, and Amman — safe and welcoming for Muslim travelers.</p><h3>10. Qatar</h3><p>World-class museums, shopping, and culture in Doha with excellent halal options.</p>',
        'author' => 'Travel Desk',
        'category' => 'travel',
        'active' => 1,
    ],
    [
        'title' => 'How to Prepare for Your First Hajj Pilgrimage',
        'excerpt' => 'A practical checklist to help first-time pilgrims prepare physically, mentally, and spiritually.',
        'content' => '<h3>Spiritual Preparation</h3><p>Begin by learning about the rituals of Hajj. Read books, attend seminars, and make sincere intention (niyyah). Increase your daily prayers and charity.</p><h3>Physical Preparation</h3><p>Start walking daily to build endurance. You will walk long distances in Mina, Arafat, and Muzdalifah. Stay hydrated and eat healthy.</p><h3>Packing Checklist</h3><ul><li>Ihram clothing (two pieces for men)</li><li>Comfortable sandals</li><li>Medications and first aid kit</li><li>Sunscreen and umbrella</li><li>Small backpack</li><li>Water bottle</li><li>Prayer mat</li><li>Quran and dua book</li></ul><h3>Practical Tips</h3><p>Label your belongings. Keep copies of your passport and visa. Stay with your group. Use the Al Moqadas app for updates. Conserve energy for the important days.</p>',
        'author' => 'Hajj Department',
        'category' => 'hajj',
        'active' => 1,
    ],
];

foreach ($posts as $p) {
    $slug = Post::slugify($p['title']);
    $existing = Post::findBySlug($slug);
    if ($existing) {
        echo "Exists: {$p['title']}\n";
        continue;
    }
    if (!isset($p['featured'])) $p['featured'] = 0;
    $p['slug'] = $slug;
    $p['published_at'] = date('Y-m-d H:i:s', strtotime('-' . rand(1, 60) . ' days'));
    Post::create($p);
    echo "Created: {$p['title']}\n";
}

echo "Done.\n";
