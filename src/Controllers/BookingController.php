<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\View;
use App\Core\Response;
use App\Core\Validator;
use App\Models\Booking;
use App\Models\Package;
use App\Services\MailService;

class BookingController
{
    public function create(Request $request): void
    {
        $slug = $request->param('slug');
        $pkg = Package::findBySlug($slug);

        if (!$pkg) {
            View::render('errors.404', ['title' => 'Not Found'], 'main', 404);
            return;
        }

        View::render('booking.create', [
            'title'       => 'Book ' . $pkg['title'] . ' — Al Moqadas Travel Agency',
            'description' => 'Book your ' . $pkg['title'] . ' package online.',
            'pkg'         => $pkg,
        ], 'main');
    }

    public function store(Request $request): void
    {
        $data = [
            'package_id'    => (int) $request->post('package_id', 0),
            'package_title' => trim($request->post('package_title', '')),
            'full_name'     => trim($request->post('full_name', '')),
            'phone'         => trim($request->post('phone', '')),
            'email'         => trim($request->post('email', '')),
            'travel_date'   => trim($request->post('travel_date', '')),
            'group_size'    => (int) $request->post('group_size', 1),
            'service'       => trim($request->post('service', '')),
            'message'       => trim($request->post('message', '')),
        ];

        $validator = new Validator();
        $rules = [
            'full_name'   => 'required|min:2|max:100',
            'phone'       => 'required|phone',
            'email'       => 'email',
            'group_size'  => 'required|numeric|min:1|max:100',
            'travel_date' => 'required|date',
        ];

        if (!$validator->validate($data, $rules)) {
            Response::json([
                'success' => false,
                'error'   => $validator->firstError(),
            ], 422);
            return;
        }

        $data['ip_address'] = $request->ip();
        $bookingId = Booking::create($data);
        $booking = Booking::find($bookingId);

        MailService::send(
            setting('contact_email', 'info@almoqadas.com'),
            'New Booking: ' . $booking['booking_ref'] . ' — ' . $data['full_name'],
            sprintf(
                '<h2>New Booking</h2>
                 <p><strong>Reference:</strong> %s</p>
                 <p><strong>Package:</strong> %s</p>
                 <p><strong>Name:</strong> %s</p>
                 <p><strong>Phone:</strong> %s</p>
                 <p><strong>Email:</strong> %s</p>
                 <p><strong>Travel Date:</strong> %s</p>
                 <p><strong>Group Size:</strong> %d</p>
                 <p><strong>Message:</strong> %s</p>
                 <p><a href="%s">View in Admin</a></p>',
                e($booking['booking_ref']),
                e($data['package_title']),
                e($data['full_name']),
                e($data['phone']),
                e($data['email']),
                e($data['travel_date']),
                $data['group_size'],
                nl2br(e($data['message'])),
                base_url('admin/bookings/view/' . $bookingId)
            )
        );

        Response::json([
            'success' => true,
            'booking_ref' => $booking['booking_ref'],
            'redirect' => base_url('booking/confirm/' . $bookingId),
        ]);
    }

    public function confirm(Request $request): void
    {
        $id = (int) $request->param('id');
        $booking = Booking::find($id);

        if (!$booking) {
            View::render('errors.404', ['title' => 'Not Found'], 'main', 404);
            return;
        }

        View::render('booking.confirm', [
            'title'       => 'Booking Confirmed — Al Moqadas Travel Agency',
            'description' => 'Your booking has been received.',
            'booking'     => $booking,
        ], 'main');
    }
}
