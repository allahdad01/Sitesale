<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;

class ServicesController
{
    public function index(Request $request): void
    {
        View::render('services', [
            'title'       => 'Our Services — Al Moqadas Travel Agency',
            'description' => 'From Umrah and Hajj packages to flight bookings, visa services, hotels, and custom tours.',
            'current_page' => 'services',
        ], 'main');
    }
}
