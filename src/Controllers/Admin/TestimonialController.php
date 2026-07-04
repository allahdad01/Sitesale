<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Testimonial;

class TestimonialController
{
    public function index(): void
    {
        $testimonials = Testimonial::allAdmin();
        View::render('admin.testimonials.index', [
            'title'        => 'Testimonials',
            'testimonials' => $testimonials,
        ], 'admin');
    }

    public function add(Request $request): void
    {
        $uploadDir = __DIR__ . '/../../../storage/uploads/testimonials/';
        $avatar = '';

        if (!empty($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $ext = strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                $avatar = 'testi_' . bin2hex(random_bytes(8)) . '.' . $ext;
                move_uploaded_file($_FILES['avatar']['tmp_name'], $uploadDir . $avatar);
            }
        }

        Testimonial::create([
            'name'       => $request->post('name', ''),
            'position'   => $request->post('position', ''),
            'content'    => $request->post('content', ''),
            'rating'     => (int) $request->post('rating', 5),
            'avatar'     => $avatar,
            'sort_order' => Testimonial::maxSortOrder() + 1,
            'active'     => 1,
        ]);

        Session::set('_success', 'Testimonial added.');
        Response::redirect(base_url('admin/testimonials'));
    }

    public function delete(Request $request): void
    {
        $id = (int) $request->param('id');
        $testimonial = Testimonial::find($id);
        if ($testimonial && $testimonial['avatar']) {
            @unlink(__DIR__ . '/../../../storage/uploads/testimonials/' . $testimonial['avatar']);
        }
        Testimonial::delete($id);
        Session::set('_success', 'Testimonial deleted.');
        Response::redirect(base_url('admin/testimonials'));
    }
}
