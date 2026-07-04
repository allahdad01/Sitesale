<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;
use App\Models\AdminUser;
use App\Models\Booking;
use App\Models\Enquiry;

class AdminController
{
    public function login(Request $request): void
    {
        if (Session::has('admin_id')) {
            Response::redirect(base_url('admin'));
            return;
        }

        View::render('admin.login', [
            'title'       => 'Admin Login',
            'description' => '',
        ], 'none');
    }

    public function authenticate(Request $request): void
    {
        $username = $request->post('username', '');
        $password = $request->post('password', '');

        if (empty($username) || empty($password)) {
            Session::set('_error', 'Please enter both username and password.');
            Response::redirect(base_url('admin/login'));
            return;
        }

        $user = AdminUser::findByUsername($username);

        if (!$user || !AdminUser::verifyPassword($password, $user['password'])) {
            Session::set('_error', 'Invalid username or password.');
            Response::redirect(base_url('admin/login'));
            return;
        }

        Session::regenerate();
        Session::set('admin_id', $user['id']);
        Session::set('admin_username', $user['username']);
        Session::remove('_error');

        $redirect = Session::get('_redirect_to', 'admin');
        Session::remove('_redirect_to');
        Response::redirect(base_url($redirect));
    }

    public function dashboard(Request $request): void
    {
        $pendingCount    = Enquiry::countByStatus('pending');
        $readCount       = Enquiry::countByStatus('read');
        $repliedCount    = Enquiry::countByStatus('replied');
        $totalEnquiries  = $pendingCount + $readCount + $repliedCount;
        $monthlyEnquiries = Enquiry::monthlyCounts(6);
        $recentEnquiries = Enquiry::recent(5);
        $thisMonthEnq    = Enquiry::countThisMonth();

        $pendingBookings    = Booking::countByStatus('pending');
        $confirmedBookings  = Booking::countByStatus('confirmed');
        $completedBookings  = Booking::countByStatus('completed');
        $cancelledBookings  = Booking::countByStatus('cancelled');
        $totalBookings      = $pendingBookings + $confirmedBookings + $completedBookings + $cancelledBookings;
        $thisMonthBookings  = Booking::countThisMonth();
        $monthlyBookings    = Booking::monthlyCounts(6);
        $recentBookings     = Booking::all(5);

        $maxMonthly = 1;
        if (!empty($monthlyEnquiries)) {
            $values = array_column($monthlyEnquiries, 'value');
            $maxMonthly = max($values);
        }

        View::render('admin.dashboard', [
            'title'             => 'Admin Dashboard',
            'description'       => '',
            'totalEnquiries'    => $totalEnquiries,
            'pendingEnquiries'  => $pendingCount,
            'readCount'         => $readCount,
            'repliedCount'      => $repliedCount,
            'monthlyEnquiries'  => $monthlyEnquiries,
            'recentEnquiries'   => $recentEnquiries,
            'thisMonthEnq'      => $thisMonthEnq,
            'totalBookings'     => $totalBookings,
            'pendingBookings'   => $pendingBookings,
            'confirmedBookings' => $confirmedBookings,
            'completedBookings' => $completedBookings,
            'cancelledBookings' => $cancelledBookings,
            'thisMonthBookings' => $thisMonthBookings,
            'monthlyBookings'   => $monthlyBookings,
            'recentBookings'    => $recentBookings,
            'maxMonthly'        => $maxMonthly,
            'todayLabel'        => date('l, j F Y'),
        ], 'admin');
    }

    public function logout(Request $request): void
    {
        Session::destroy();
        Response::redirect(base_url('admin/login'));
    }
}
