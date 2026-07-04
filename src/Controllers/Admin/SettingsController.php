<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Setting;

class SettingsController
{
    public function index(Request $request): void
    {
        $settings = Setting::all();

        $groups = [
            'brand'   => ['label' => 'Brand & Identity',   'keys' => ['site_name', 'site_tagline', 'logo_text', 'logo_icon', 'logo_image', 'favicon']],
            'colors'  => ['label' => 'Colors & Theme',     'keys' => ['color_primary', 'color_primary_dark', 'color_primary_light', 'color_navy', 'color_navy_dark', 'color_navy_light', 'color_bg', 'color_bg2']],
            'contact' => ['label' => 'Contact Information', 'keys' => ['contact_phone', 'contact_email', 'contact_address', 'whatsapp_number']],
            'social'  => ['label' => 'Social Media',        'keys' => ['social_facebook', 'social_twitter', 'social_linkedin', 'social_instagram']],
            'content' => ['label' => 'Content',             'keys' => ['hero_title', 'hero_subtitle', 'footer_description', 'footer_copyright', 'meta_description']],
            'seo'     => ['label' => 'SEO & Analytics',     'keys' => ['meta_keywords', 'google_analytics_id']],
        ];

        $imageKeys = ['logo_image', 'favicon'];

        View::render('admin.settings', [
            'title'     => 'Platform Settings',
            'settings'  => $settings,
            'groups'    => $groups,
            'imageKeys' => $imageKeys,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $data = $request->all();
        unset($data['_csrf_token']);

        if (isset($data['_remove_image'])) {
            $removeKey = $data['_remove_image'];
            $oldFile = Setting::get($removeKey);
            if ($oldFile) {
                $path = __DIR__ . '/../../../storage/uploads/' . basename($oldFile);
                if (file_exists($path)) @unlink($path);
            }
            Setting::set($removeKey, '');
            Setting::flushCache();
            Session::set('_success', 'Image removed.');
            Response::redirect(base_url('admin/settings'));
            return;
        }

        foreach ($data as $key => $value) {
            Setting::set($key, $value);
        }

        $uploadDir = __DIR__ . '/../../../storage/uploads/';
        $imageKeys = ['logo_image', 'favicon'];

        foreach ($imageKeys as $key) {
            $fileKey = $key . '_file';
            if (!empty($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES[$fileKey]['name'], PATHINFO_EXTENSION));
                if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'ico'])) {
                    continue;
                }
                $filename = $key . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES[$fileKey]['tmp_name'], $uploadDir . $filename);
                Setting::set($key, $filename);
            }
        }

        Setting::flushCache();
        Session::set('_success', 'Settings saved successfully.');
        Response::redirect(base_url('admin/settings'));
    }
}
