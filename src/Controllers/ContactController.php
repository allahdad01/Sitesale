<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Core\Response;
use App\Models\Faq;
use App\Services\ContactService;

class ContactController
{
    public function index(Request $request): void
    {
        View::render('contact', [
            'title'       => 'Contact Us — Al Moqadas Travel Agency',
            'description' => 'Get in touch with Al Moqadas for Umrah, Hajj, flight bookings, visa services, and travel inquiries.',
            'current_page' => 'contact',
            'faqs'        => Faq::all(),
        ], 'main');
    }

    public function submit(Request $request): void
    {
        $service = new ContactService();
        $result  = $service->handleEnquiry($request);

        Response::json($result, $result['success'] ? 200 : 422);
    }
}
