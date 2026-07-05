<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Setting;

class FooterController
{
    public function index(): void
    {
        View::render('admin.footer.index', [
            'title' => 'Footer',
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
        Session::set('_success', 'Footer content updated.');
        Response::redirect(base_url('admin/footer'));
    }
}
