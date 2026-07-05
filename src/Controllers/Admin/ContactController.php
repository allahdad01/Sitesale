<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Setting;

class ContactController
{
    public function index(): void
    {
        View::render('admin.contact.index', [
            'title' => 'Contact Page',
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $data = $request->all();
        unset($data['_csrf_token']);

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        Setting::flushCache();
        Session::set('_success', 'Contact page content updated.');
        Response::redirect(base_url('admin/contact'));
    }
}
