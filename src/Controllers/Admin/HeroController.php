<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\HeroSlide;
use App\Models\Setting;

class HeroController
{
    public function index(): void
    {
        $slides = HeroSlide::allAdmin();
        View::render('admin.hero.index', [
            'title'  => 'Hero Content',
            'slides' => $slides,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $uploadDir = __DIR__ . '/../../../storage/uploads/hero/';

        $textKeys = [
            'hero_badge', 'hero_title', 'hero_subtitle',
            'hero_btn1_text', 'hero_btn1_url',
            'hero_btn2_text', 'hero_btn2_url',
            'hero_stat1_num', 'hero_stat1_label',
            'hero_stat2_num', 'hero_stat2_label',
            'hero_stat3_num', 'hero_stat3_label',
            'hero_stat4_num', 'hero_stat4_label',
        ];

        foreach ($textKeys as $key) {
            Setting::set($key, $request->post($key, ''));
        }

        // Handle kaaba image upload
        if (!empty($_FILES['hero_kaaba_img_file']) && $_FILES['hero_kaaba_img_file']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['hero_kaaba_img_file']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $old = Setting::get('hero_kaaba_img', '');
                if ($old && !str_starts_with($old, 'http')) {
                    @unlink($uploadDir . $old);
                }
                $filename = 'kaaba_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['hero_kaaba_img_file']['tmp_name'], $uploadDir . $filename);
                Setting::set('hero_kaaba_img', $filename);
            }
        }

        Setting::flushCache();
        Session::set('_success', 'Hero text and stats updated.');
        Response::redirect(base_url('admin/hero'));
    }

    public function addSlide(Request $request): void
    {
        $uploadDir = __DIR__ . '/../../../storage/uploads/hero/';

        $label = $request->post('label', '');
        $image = '';

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $image = 'slide_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
            }
        }

        if (!$image) {
            Session::set('_error', 'Slide image is required.');
            Response::redirect(base_url('admin/hero'));
            return;
        }

        HeroSlide::create([
            'image'      => $image,
            'label'      => $label,
            'sort_order' => HeroSlide::maxSortOrder() + 1,
            'active'     => 1,
        ]);

        Session::set('_success', 'Slide added.');
        Response::redirect(base_url('admin/hero'));
    }

    public function deleteSlide(Request $request): void
    {
        $id = (int) $request->param('id');
        $slide = HeroSlide::find($id);
        if ($slide) {
            if ($slide['image']) {
                @unlink(__DIR__ . '/../../../storage/uploads/hero/' . $slide['image']);
            }
            HeroSlide::delete($id);
        }
        Session::set('_success', 'Slide deleted.');
        Response::redirect(base_url('admin/hero'));
    }
}
