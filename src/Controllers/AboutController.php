<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Models\PageSection;
use App\Models\TeamMember;
use App\Models\TimelineItem;

class AboutController
{
    public function index(Request $request): void
    {
        $allSections = PageSection::getActive('about');
        $activeKeys = array_map(fn($s) => $s['section_key'], $allSections);
        $customSections = array_filter($allSections, fn($s) => $s['type'] === 'custom_html');

        if (empty($activeKeys)) {
            $activeKeys = ['hero', 'intro', 'stats', 'values', 'timeline', 'team', 'cta'];
        }

        View::render('about', [
            'title'          => setting('about_meta_title', 'About Us — Al Moqadas Travel Agency'),
            'description'    => setting('about_meta_description', 'Learn about our story since 2010, our mission, vision, values, and the team behind Al Moqadas.'),
            'current_page'   => 'about',
            'activeSections' => $activeKeys,
            'customSections' => $customSections,
            'teamLead'       => TeamMember::lead(),
            'teamMembers'    => TeamMember::members(),
            'timelineItems'  => TimelineItem::all(),
        ], 'main');
    }
}
