<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;

class DestinationsController
{
    public function index(Request $request): void
    {
        View::render('destinations', [
            'title'       => 'Destinations — Al Moqadas Travel Agency',
            'description' => 'Explore our 30+ destinations worldwide, from sacred cities to cultural capitals.',
            'current_page' => 'destinations',
        ], 'main');
    }
}
