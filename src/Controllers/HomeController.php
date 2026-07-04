<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Models\HeroSlide;
use App\Models\Package;
use App\Models\Award;
use App\Models\Testimonial;
use App\Models\PageSection;
use App\Models\Post;
use App\Models\Service;

class HomeController
{
    public function index(Request $request): void
    {
        $allSections = PageSection::getActive('home');
        $activeKeys = array_map(fn($s) => $s['section_key'], $allSections);
        $customSections = array_filter($allSections, fn($s) => $s['type'] === 'custom_html');
        $featuredPackages = Package::featured(6);
        $recentPosts = Post::all(3);
        $heroSlides = HeroSlide::all();
        $awards = Award::all();
        $testimonials = Testimonial::all();
        $services = Service::all();

        View::render('home', [
            'title'            => 'Al Moqadas Travel Agency - Hajj, Umrah & Worldwide Travel',
            'description'      => 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.',
            'current_page'     => 'home',
            'activeSections'   => $activeKeys,
            'customSections'   => $customSections,
            'featuredPackages' => $featuredPackages,
            'recentPosts'      => $recentPosts,
            'heroSlides'       => $heroSlides,
            'awards'           => $awards,
            'testimonials'     => $testimonials,
            'services'         => $services,
        ], 'main');
    }
}
