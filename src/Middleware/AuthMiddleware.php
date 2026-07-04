<?php

namespace App\Middleware;

use App\Core\Request;
use App\Core\Session;
use App\Core\Response;

class AuthMiddleware
{
    public function handle(Request $request): void
    {
        if (!Session::has('admin_id')) {
            Session::set('_redirect_to', $request->uri());
            Response::redirect(base_url('admin/login'));
            exit;
        }
    }
}
