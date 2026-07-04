<?php

namespace App\Controllers\Admin;

use App\Core\Request;
use App\Core\Response;
use App\Core\View;
use App\Core\Session;
use App\Models\Booking;
use App\Services\MailService;

class BookingController
{
    public function index(Request $request): void
    {
        $status = $request->get('status', '');
        $bookings = Booking::all(100, $status);

        View::render('admin.bookings.index', [
            'title'     => 'Bookings',
            'bookings'  => $bookings,
            'status'    => $status,
        ], 'admin');
    }

    public function view(Request $request): void
    {
        $id = (int) $request->param('id');
        $booking = Booking::find($id);

        if (!$booking) {
            Response::redirect(base_url('admin/bookings'));
            return;
        }

        View::render('admin.bookings.show', [
            'title'   => 'Booking #' . $booking['booking_ref'],
            'booking' => $booking,
        ], 'admin');
    }

    public function confirm(Request $request): void
    {
        $id = (int) $request->param('id');
        $booking = Booking::find($id);

        if (!$booking) {
            Response::redirect(base_url('admin/bookings'));
            return;
        }

        Booking::updateStatus($id, 'confirmed');

        MailService::send(
            $booking['email'] ?: '',
            'Booking Confirmed: ' . $booking['booking_ref'] . ' — Al Moqadas Travel Agency',
            sprintf(
                '<h2>Booking Confirmed</h2>
                 <p>Dear %s,</p>
                 <p>Your booking <strong>%s</strong> has been confirmed.</p>
                 <p><strong>Package:</strong> %s</p>
                 <p><strong>Travel Date:</strong> %s</p>
                 <p><strong>Group Size:</strong> %d</p>
                 <p>Our team will contact you on <strong>%s</strong> with further details.</p>
                 <p>Thank you for choosing Al Moqadas Travel Agency.</p>',
                e($booking['full_name']),
                e($booking['booking_ref']),
                e($booking['package_title'] ?? '—'),
                e($booking['travel_date'] ?? '—'),
                (int) $booking['group_size'],
                e($booking['phone'])
            )
        );

        Session::set('_success', 'Booking ' . $booking['booking_ref'] . ' confirmed.');
        Response::redirect(base_url('admin/bookings/view/' . $id));
    }

    public function complete(Request $request): void
    {
        $id = (int) $request->param('id');
        Booking::updateStatus($id, 'completed');
        Session::set('_success', 'Booking marked as completed.');
        Response::redirect(base_url('admin/bookings/view/' . $id));
    }

    public function cancel(Request $request): void
    {
        $id = (int) $request->param('id');
        Booking::updateStatus($id, 'cancelled');

        $booking = Booking::find($id);

        if ($booking && $booking['email']) {
            MailService::send(
                $booking['email'],
                'Booking Cancelled: ' . $booking['booking_ref'] . ' — Al Moqadas Travel Agency',
                sprintf(
                    '<h2>Booking Cancelled</h2>
                     <p>Dear %s,</p>
                     <p>Your booking <strong>%s</strong> has been cancelled as requested.</p>
                     <p>If you have any questions, please contact us.</p>
                     <p>Thank you.</p>',
                    e($booking['full_name']),
                    e($booking['booking_ref'])
                )
            );
        }

        Session::set('_success', 'Booking cancelled.');
        Response::redirect(base_url('admin/bookings/view/' . $id));
    }

    public function updateNotes(Request $request): void
    {
        $id = (int) $request->param('id');
        $notes = trim($request->post('admin_notes', ''));
        Booking::updateNotes($id, $notes);
        Session::set('_success', 'Notes updated.');
        Response::redirect(base_url('admin/bookings/view/' . $id));
    }
}
