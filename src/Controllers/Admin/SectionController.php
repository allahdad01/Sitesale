<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\PageSection;

class SectionController
{
    public function index(Request $request): void
    {
        $sections = PageSection::all('home');

        View::render('admin.sections.index', [
            'title'    => 'Home Page Sections',
            'sections' => $sections,
        ], 'admin');
    }

    public function add(Request $request): void
    {
        View::render('admin.sections.form', [
            'title'   => 'Add Section',
            'section' => null,
        ], 'admin');
    }

    public function store(Request $request): void
    {
        $sectionKey = $request->post('section_key', '');
        if (empty($sectionKey)) {
            $sectionKey = 'custom_' . bin2hex(random_bytes(4));
        }

        PageSection::create([
            'page'        => 'home',
            'section_key' => $sectionKey,
            'label'       => $request->post('label', ''),
            'type'        => $request->post('type', 'custom_html'),
            'content'     => $request->post('content', ''),
            'active'      => $request->post('active', 1),
        ]);

        Session::set('_success', 'Section added.');
        Response::redirect(base_url('admin/sections'));
    }

    public function edit(Request $request): void
    {
        $id = (int) $request->param('id');
        $section = PageSection::find($id);

        if (!$section) {
            Session::set('_error', 'Section not found.');
            Response::redirect(base_url('admin/sections'));
            return;
        }

        View::render('admin.sections.form', [
            'title'   => 'Edit Section',
            'section' => $section,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $id = (int) $request->param('id');

        PageSection::update($id, [
            'label'       => $request->post('label', ''),
            'content'     => $request->post('content', ''),
            'active'      => (int) $request->post('active', 0),
            'section_key' => $request->post('section_key', ''),
        ]);

        Session::set('_success', 'Section updated.');
        Response::redirect(base_url('admin/sections'));
    }

    public function toggle(Request $request): void
    {
        $id = (int) $request->param('id');
        PageSection::toggle($id);
        Response::redirect(base_url('admin/sections'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');

        $section = PageSection::find($id);
        if ($section && $section['type'] === 'builtin') {
            Session::set('_error', 'Cannot remove a built-in section. Deactivate it instead.');
            Response::redirect(base_url('admin/sections'));
            return;
        }

        PageSection::delete($id);
        Session::set('_success', 'Section removed.');
        Response::redirect(base_url('admin/sections'));
    }

    public function reorder(Request $request): void
    {
        $order = $request->post('order', []);
        if (is_array($order)) {
            PageSection::reorder($order);
        }
        Session::set('_success', 'Order updated.');
        Response::redirect(base_url('admin/sections'));
    }
}
