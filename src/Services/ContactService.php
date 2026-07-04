<?php

namespace App\Services;

use App\Models\Enquiry;
use App\Core\Validator;
use App\Core\Request;
use App\Services\MailService;

class ContactService
{
    public function handleEnquiry(Request $request): array
    {
        $data = [
            'full_name' => trim($request->post('full_name', '')),
            'phone'     => trim($request->post('phone', '')),
            'email'     => trim($request->post('email', '')),
            'service'   => trim($request->post('service', '')),
            'message'   => trim($request->post('message', '')),
        ];

        $validator = new Validator();
        $rules = [
            'full_name' => 'required|min:2|max:100',
            'phone'     => 'required|phone',
            'email'     => 'email',
            'message'   => 'max:2000',
        ];

        if (!$validator->validate($data, $rules)) {
            return [
                'success' => false,
                'error'   => $validator->firstError(),
            ];
        }

        $data['ip_address'] = $request->ip();
        Enquiry::create($data);

        MailService::send(
            setting('contact_email', 'info@almoqadas.com'),
            'New Enquiry: ' . $data['service'],
            sprintf(
                '<h2>New Enquiry</h2>
                 <p><strong>Name:</strong> %s</p>
                 <p><strong>Phone:</strong> %s</p>
                 <p><strong>Email:</strong> %s</p>
                 <p><strong>Service:</strong> %s</p>
                 <p><strong>Message:</strong> %s</p>',
                e($data['full_name']),
                e($data['phone']),
                e($data['email']),
                e($data['service']),
                nl2br(e($data['message']))
            )
        );

        return [
            'success' => true,
            'message' => 'Thank you! We have received your enquiry and will get back to you shortly.',
        ];
    }
}
