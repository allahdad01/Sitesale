<?php

namespace App\Controllers;

use App\Core\Request;
use App\Core\Response;

class LocaleController
{
    public function switch(Request $request): void
    {
        $locale = $request->param('locale', 'en');
        $allowed = ['en', 'ps', 'fa'];

        if (in_array($locale, $allowed)) {
            $_SESSION['_locale'] = $locale;
        }

        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $baseUrl = rtrim((!empty($_ENV['APP_URL']) ? $_ENV['APP_URL'] : dirname($_SERVER['SCRIPT_NAME'])), '/');

        if (!empty($referer) && parse_url($referer, PHP_URL_HOST) === ($_SERVER['HTTP_HOST'] ?? '')) {
            Response::redirect($referer);
        }

        Response::redirect($baseUrl ?: '/');
    }
}
