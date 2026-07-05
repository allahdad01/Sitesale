<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Package;

class PackageController
{
    public function index(): void
    {
        View::render('admin.packages.index', [
            'title'    => 'Packages',
            'packages' => Package::allAdmin(),
        ], 'admin');
    }

    public function add(): void
    {
        View::render('admin.packages.form', [
            'title'   => 'Add Package',
            'pkg'     => null,
        ], 'admin');
    }

    public function store(Request $request): void
    {
        $slug = $request->post('slug', '');
        if (empty($slug)) $slug = Package::slugify($request->post('title', ''));

        $image = $this->handleUpload('image');

        Package::create([
            'title'          => $request->post('title', ''),
            'title_en'       => $request->post('title_en', ''),
            'title_ps'       => $request->post('title_ps', ''),
            'title_fa'       => $request->post('title_fa', ''),
            'slug'           => $slug,
            'description'    => $request->post('description', ''),
            'description_en' => $request->post('description_en', ''),
            'description_ps' => $request->post('description_ps', ''),
            'description_fa' => $request->post('description_fa', ''),
            'image'          => $image,
            'price'          => str_replace(',', '', $request->post('price', '0')),
            'duration_days'  => (int) $request->post('duration_days', 1),
            'max_people'     => (int) $request->post('max_people', 1),
            'category'       => $request->post('category', 'tour'),
            'destination'    => $request->post('destination', ''),
            'destination_en' => $request->post('destination_en', ''),
            'destination_ps' => $request->post('destination_ps', ''),
            'destination_fa' => $request->post('destination_fa', ''),
            'featured'       => (int) $request->post('featured', 0),
            'active'         => (int) $request->post('active', 1),
        ]);

        Session::set('_success', 'Package created.');
        Response::redirect(base_url('admin/packages'));
    }

    public function edit(Request $request): void
    {
        $pkg = Package::find((int) $request->param('id'));
        if (!$pkg) { Session::set('_error', 'Not found.'); Response::redirect(base_url('admin/packages')); return; }

        View::render('admin.packages.form', [
            'title' => 'Edit Package',
            'pkg'   => $pkg,
        ], 'admin');
    }

    public function update(Request $request): void
    {
        $id = (int) $request->param('id');
        $pkg = Package::find($id);
        if (!$pkg) { Session::set('_error', 'Not found.'); Response::redirect(base_url('admin/packages')); return; }

        $image = $pkg['image'];
        $uploaded = $this->handleUpload('image');
        if ($uploaded) {
            if ($image) @unlink(__DIR__ . '/../../../storage/uploads/' . $image);
            $image = $uploaded;
        }

        Package::update($id, [
            'title'          => $request->post('title', ''),
            'title_en'       => $request->post('title_en', ''),
            'title_ps'       => $request->post('title_ps', ''),
            'title_fa'       => $request->post('title_fa', ''),
            'slug'           => $request->post('slug', ''),
            'description'    => $request->post('description', ''),
            'description_en' => $request->post('description_en', ''),
            'description_ps' => $request->post('description_ps', ''),
            'description_fa' => $request->post('description_fa', ''),
            'image'          => $image,
            'price'          => str_replace(',', '', $request->post('price', '0')),
            'duration_days'  => (int) $request->post('duration_days', 1),
            'max_people'     => (int) $request->post('max_people', 1),
            'category'       => $request->post('category', 'tour'),
            'destination'    => $request->post('destination', ''),
            'destination_en' => $request->post('destination_en', ''),
            'destination_ps' => $request->post('destination_ps', ''),
            'destination_fa' => $request->post('destination_fa', ''),
            'featured'       => (int) $request->post('featured', 0),
            'active'         => (int) $request->post('active', 1),
        ]);

        Session::set('_success', 'Package updated.');
        Response::redirect(base_url('admin/packages'));
    }

    public function toggle(Request $request): void
    {
        Package::toggle((int) $request->param('id'));
        Response::redirect(base_url('admin/packages'));
    }

    public function toggleFeatured(Request $request): void
    {
        Package::toggleFeatured((int) $request->param('id'));
        Response::redirect(base_url('admin/packages'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        $pkg = Package::find($id);
        if ($pkg && $pkg['image']) {
            @unlink(__DIR__ . '/../../../storage/uploads/' . $pkg['image']);
        }
        Package::delete($id);
        Session::set('_success', 'Package deleted.');
        Response::redirect(base_url('admin/packages'));
    }

    private function handleUpload(string $field): string|null
    {
        if (empty($_FILES[$field]) || $_FILES[$field]['error'] !== UPLOAD_ERR_OK) return null;
        $ext = strtolower(pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION));
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) return null;
        $filename = $field . '_' . bin2hex(random_bytes(8)) . '.' . $ext;
        move_uploaded_file($_FILES[$field]['tmp_name'], __DIR__ . '/../../../storage/uploads/' . $filename);
        return $filename;
    }
}
