<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Award;
use App\Models\Setting;

class AwardsController
{
    public function index(): void
    {
        $awards = Award::allAdmin();
        View::render('admin.awards.index', [
            'title'  => 'Awards',
            'awards' => $awards,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        Setting::set('awards_badge', $request->post('awards_badge', ''));
        Setting::set('awards_badge_ps', $request->post('awards_badge_ps', ''));
        Setting::set('awards_badge_fa', $request->post('awards_badge_fa', ''));
        Setting::set('awards_title', $request->post('awards_title', ''));
        Setting::set('awards_title_ps', $request->post('awards_title_ps', ''));
        Setting::set('awards_title_fa', $request->post('awards_title_fa', ''));
        Setting::set('awards_subtitle', $request->post('awards_subtitle', ''));
        Setting::set('awards_subtitle_ps', $request->post('awards_subtitle_ps', ''));
        Setting::set('awards_subtitle_fa', $request->post('awards_subtitle_fa', ''));
        Setting::flushCache();
        Session::set('_success', 'Awards text updated.');
        Response::redirect(base_url('admin/awards'));
    }

    public function add(Request $request): void
    {
        $uploadDir = __DIR__ . '/../../../storage/uploads/awards/';
        $label = $request->post('label', '');
        $image = '';

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $image = 'award_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
            }
        }

        if (!$image) {
            Session::set('_error', 'Award image is required.');
            Response::redirect(base_url('admin/awards'));
            return;
        }

        Award::create([
            'image'      => $image,
            'label'      => $label,
            'label_en'   => $request->post('label_en', ''),
            'label_ps'   => $request->post('label_ps', ''),
            'label_fa'   => $request->post('label_fa', ''),
            'sort_order' => Award::maxSortOrder() + 1,
            'active'     => 1,
        ]);

        Session::set('_success', 'Award added.');
        Response::redirect(base_url('admin/awards'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        $award = Award::find($id);
        if ($award) {
            if ($award['image']) {
                @unlink(__DIR__ . '/../../../storage/uploads/awards/' . $award['image']);
            }
            Award::delete($id);
        }
        Session::set('_success', 'Award deleted.');
        Response::redirect(base_url('admin/awards'));
    }
}
