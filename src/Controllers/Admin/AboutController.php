<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Setting;

class AboutController
{
    public function index(): void
    {
        View::render('admin.about.index', [
            'title' => 'About Page',
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $data = $request->all();
        unset($data['_csrf_token']);

        $uploadDir = __DIR__ . '/../../../storage/uploads/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        if (isset($data['_remove_image'])) {
            $removeKey = $data['_remove_image'];
            $oldFile = Setting::get($removeKey);
            if ($oldFile) {
                $path = $uploadDir . basename($oldFile);
                if (file_exists($path)) @unlink($path);
            }
            Setting::set($removeKey, '');
            Setting::flushCache();
            Session::set('_success', 'Image removed.');
            Response::redirect(base_url('admin/about'));
            return;
        }

        $imageKeys = ['about_intro_image'];

        foreach ($imageKeys as $key) {
            $fileKey = $key . '_file';
            if (!empty($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
                if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                    $oldFile = Setting::get($key);
                    if ($oldFile) {
                        @unlink($uploadDir . basename($oldFile));
                    }
                    $filename = $key . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
                    move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadDir . $filename);
                    $data[$key] = $filename;
                }
            }
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        Setting::flushCache();
        Session::set('_success', 'About page content updated.');
        Response::redirect(base_url('admin/about'));
    }
}
