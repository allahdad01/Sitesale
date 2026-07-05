<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\TimelineItem;

class TimelineController
{
    public function index(): void
    {
        $items = TimelineItem::allAdmin();
        View::render('admin.timeline.index', [
            'title' => 'Timeline',
            'items' => $items,
        ], 'admin');
    }

    public function add(Request $request): void
    {
        TimelineItem::create([
            'year'    => $request->post('year', ''),
            'year_en' => $request->post('year_en', ''),
            'year_ps' => $request->post('year_ps', ''),
            'year_fa' => $request->post('year_fa', ''),
            'title'   => $request->post('title', ''),
            'title_en' => $request->post('title_en', ''),
            'title_ps' => $request->post('title_ps', ''),
            'title_fa' => $request->post('title_fa', ''),
            'text'    => $request->post('text', ''),
            'text_en' => $request->post('text_en', ''),
            'text_ps' => $request->post('text_ps', ''),
            'text_fa' => $request->post('text_fa', ''),
            'sort_order' => TimelineItem::maxSortOrder() + 1,
            'active'     => 1,
        ]);

        Session::set('_success', 'Timeline item added.');
        Response::redirect(base_url('admin/timeline'));
    }

    public function edit(Request $request): void
    {
        $id = (int) $request->param('id');
        $item = TimelineItem::find($id);
        if (!$item) {
            Session::set('_error', 'Timeline item not found.');
            Response::redirect(base_url('admin/timeline'));
            return;
        }
        View::render('admin.timeline.form', [
            'title' => 'Edit Timeline Item',
            'item'  => $item,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $id = (int) $request->param('id');
        $item = TimelineItem::find($id);
        if (!$item) {
            Session::set('_error', 'Timeline item not found.');
            Response::redirect(base_url('admin/timeline'));
            return;
        }

        TimelineItem::update($id, [
            'year'     => $request->post('year', ''),
            'year_en'  => $request->post('year_en', ''),
            'year_ps'  => $request->post('year_ps', ''),
            'year_fa'  => $request->post('year_fa', ''),
            'title'    => $request->post('title', ''),
            'title_en' => $request->post('title_en', ''),
            'title_ps' => $request->post('title_ps', ''),
            'title_fa' => $request->post('title_fa', ''),
            'text'     => $request->post('text', ''),
            'text_en'  => $request->post('text_en', ''),
            'text_ps'  => $request->post('text_ps', ''),
            'text_fa'  => $request->post('text_fa', ''),
        ]);

        Session::set('_success', 'Timeline item updated.');
        Response::redirect(base_url('admin/timeline'));
    }

    public function toggle(Request $request): void
    {
        $id = (int) $request->param('id');
        $item = TimelineItem::find($id);
        if ($item) {
            TimelineItem::update($id, ['active' => $item['active'] ? 0 : 1]);
        }
        Session::set('_success', 'Timeline item toggled.');
        Response::redirect(base_url('admin/timeline'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        TimelineItem::delete($id);
        Session::set('_success', 'Timeline item deleted.');
        Response::redirect(base_url('admin/timeline'));
    }
}
