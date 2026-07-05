<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Service;

class ServiceController
{
    public function index(): void
    {
        $services = Service::allAdmin();
        View::render('admin.services.index', [
            'title'    => 'Services',
            'services' => $services,
        ], 'admin');
    }

    public function add(Request $request): void
    {
        $uploadDir = __DIR__ . '/../../../storage/uploads/services/';
        if (!is_dir($uploadDir)) {
            @mkdir($uploadDir, 0755, true);
        }

        $title = $request->post('title', '');
        $tag = $request->post('tag', '');
        $description = $request->post('description', '');
        $link = $request->post('link', '');
        $image = '';

        if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $image = 'service_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $image);
            }
        }

        Service::create([
            'title'          => $title,
            'title_en'       => $request->post('title_en', ''),
            'title_ps'       => $request->post('title_ps', ''),
            'title_fa'       => $request->post('title_fa', ''),
            'tag'            => $tag,
            'tag_en'         => $request->post('tag_en', ''),
            'tag_ps'         => $request->post('tag_ps', ''),
            'tag_fa'         => $request->post('tag_fa', ''),
            'description'    => $description,
            'description_en' => $request->post('description_en', ''),
            'description_ps' => $request->post('description_ps', ''),
            'description_fa' => $request->post('description_fa', ''),
            'image'          => $image,
            'link'           => $link,
            'sort_order'     => Service::maxSortOrder() + 1,
            'active'         => 1,
        ]);

        Session::set('_success', 'Service added.');
        Response::redirect(base_url('admin/services'));
    }

    public function toggle(Request $request): void
    {
        $id = (int) $request->param('id');
        $service = Service::find($id);
        if ($service) {
            Service::update($id, ['active' => $service['active'] ? 0 : 1]);
        }
        Session::set('_success', 'Service toggled.');
        Response::redirect(base_url('admin/services'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        $service = Service::find($id);
        if ($service) {
            if ($service['image'] && !str_starts_with($service['image'], 'http')) {
                @unlink(__DIR__ . '/../../../storage/uploads/services/' . $service['image']);
            }
            Service::delete($id);
        }
        Session::set('_success', 'Service deleted.');
        Response::redirect(base_url('admin/services'));
    }
}
