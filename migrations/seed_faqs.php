<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\Faq;

App::boot();

$defaults = [
    ['question' => 'What documents do I need for Umrah?',  'answer' => 'You need a valid passport (6+ months validity), passport-size photos, and a completed visa application form. We handle the rest.'],
    ['question' => 'How far in advance should I book?',    'answer' => 'We recommend booking at least 4–6 weeks before your desired travel date, especially during peak seasons like Ramadan.'],
    ['question' => 'Do you offer group discounts?',        'answer' => 'Yes! We offer special rates for groups of 5 or more travelers. Contact us for a custom group quote.'],
    ['question' => 'Can I customize my package?',          'answer' => 'Absolutely. Every package can be tailored to your preferences — hotel star rating, meal plans, extra city tours, and more.'],
    ['question' => 'What payment methods do you accept?',  'answer' => 'We accept bank transfers, cash payments at our office, and mobile money transfers. Contact us for details.'],
];

$existing = Faq::all();
if (count($existing) === 0) {
    foreach ($defaults as $i => $item) {
        Faq::create([
            'question'   => $item['question'],
            'answer'     => $item['answer'],
            'sort_order' => $i,
            'active'     => 1,
        ]);
        echo "Seeded: {$item['question']}\n";
    }
    echo "Done.\n";
} else {
    echo "FAQs already exist, skipping seed.\n";
}
