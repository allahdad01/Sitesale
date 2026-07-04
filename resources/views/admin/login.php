<?php use App\Core\Session; ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= e($title ?? 'Admin Login') ?> · Al Moqadas Travel Agency</title>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>">
</head>
<body class="login-body">

<div class="login-wrap">
  <div class="login-card">
    <div class="login-icon"><i class="fas fa-mosque"></i></div>
    <h1>Admin Login</h1>
    <p class="login-sub">Al Moqadas Travel Agency</p>

    <?php if (Session::has('_error')): ?>
      <div class="flash flash-error"><?= e(Session::get('_error')) ?><?php Session::remove('_error'); ?></div>
    <?php endif; ?>

    <form method="post" action="<?= base_url('admin/login') ?>">
      <?= csrf_field() ?>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" placeholder="Enter your username" required autocomplete="username" autofocus>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
      </div>
      <button type="submit" class="btn-login">Sign In <i class="fas fa-arrow-right"></i></button>
    </form>

    <p class="login-footer">
      <a href="<?= base_url('/') ?>">&larr; Back to website</a>
    </p>
  </div>
</div>

</body>
</html>
