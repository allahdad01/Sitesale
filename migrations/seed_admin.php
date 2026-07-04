<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Core\App;
use App\Models\AdminUser;

App::boot();

if (AdminUser::count() > 0) {
    echo "Admin user already exists. Skipping.\n";
    exit;
}

$username = 'admin';
$email    = 'admin@almoqadas.com';
$password = 'admin123';

AdminUser::create($username, $email, $password);

echo "Admin user created:\n";
echo "  Username: {$username}\n";
echo "  Password: {$password}\n";
echo "  Email:    {$email}\n";
