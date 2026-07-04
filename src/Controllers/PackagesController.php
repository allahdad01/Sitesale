<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Models\Package;

class PackagesController
{
    public function index(): void
    {
        $category = $_GET['category'] ?? '';
        $packages = Package::all($category);
        $pageTitle = $category ? ucfirst($category) . ' Packages' : 'Our Packages';
        View::render('packages.index', [
            'title'    => $pageTitle . ' — Packages',
            'packages' => $packages,
            'category' => $category,
        ]);
    }

    public function show(Request $request): void
    {
        $pkg = Package::findBySlug($request->param('slug'));
        if (!$pkg) {
            View::render('errors.404', ['title' => 'Not Found'], 'main', 404);
            return;
        }
        View::render('packages.show', [
            'title' => $pkg['title'] . ' — Packages',
            'pkg'   => $pkg,
        ]);
    }
}
