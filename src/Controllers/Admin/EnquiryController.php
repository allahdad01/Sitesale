<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\Enquiry;

class EnquiryController
{
    public function index(Request $request): void
    {
        $enquiries = Enquiry::recent(100);
        $status = $request->get('status', '');

        if ($status) {
            $all = Enquiry::recent(1000);
            $enquiries = array_filter($all, fn($e) => $e['status'] === $status);
        }

        View::render('admin.enquiries.index', [
            'title'     => 'Enquiries',
            'enquiries' => $enquiries,
        ], 'admin');
    }

    public function view(Request $request): void
    {
        $id = (int) $request->param('id');
        $enquiry = Enquiry::find($id);

        if (!$enquiry) {
            Response::redirect(base_url('admin/enquiries'));
            return;
        }

        View::render('admin.enquiries.show', [
            'title'   => 'Enquiry #' . $id,
            'enquiry' => $enquiry,
        ], 'admin');
    }

    public function markRead(Request $request): void
    {
        $id = (int) $request->param('id');
        Enquiry::updateStatus($id, 'read');
        Response::redirect(base_url('admin/enquiries'));
    }

    public function markReplied(Request $request): void
    {
        $id = (int) $request->param('id');
        Enquiry::updateStatus($id, 'replied');
        Response::redirect(base_url('admin/enquiries'));
    }
}
