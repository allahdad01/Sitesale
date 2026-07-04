<?php use App\Core\Session; ?>
<?php $favicon = setting('favicon', ''); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php if ($favicon): ?>
<link rel="icon" type="image/x-icon" href="<?= asset('storage/uploads/' . e($favicon)) ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?= asset('storage/uploads/' . e($favicon)) ?>">
<?php else: ?>
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🕋</text></svg>">
<?php endif; ?>
<title><?= e($title ?? 'Admin') ?> · <?= e(setting('site_name', 'Al Moqadas Travel Agency')) ?></title>
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?= asset('assets/css/admin.css') ?>">
</head>
<body>

<div class="layout">

  <aside class="sidebar">
    <div class="sidebar-brand">
      <?php $logoImg = setting('logo_image', ''); if ($logoImg): ?>
        <img src="<?= asset('storage/uploads/' . e($logoImg)) ?>" alt="<?= e(setting('logo_text', 'Al Moqadas')) ?>" style="height:32px;width:auto;border-radius:6px;">
      <?php else: ?>
        <div class="sidebar-brand-icon"><i class="fas <?= e(setting('logo_icon', 'fa-mosque')) ?>"></i></div>
      <?php endif; ?>
      <span><?= e(setting('logo_text', 'Al Moqadas')) ?></span>
    </div>
    <div class="nav-section-label">Main</div>
    <a href="<?= base_url('admin') ?>" class="nav-item <?= is_current_path('/admin') || is_current_path('/admin/') ? 'active' : '' ?>">
      <i class="fas fa-grip"></i> Dashboard
    </a>
    <a href="<?= base_url('admin/enquiries') ?>" class="nav-item <?= is_current_path('/admin/enquiries') ? 'active' : '' ?>">
      <i class="fas fa-message"></i> Enquiries
    </a>
    <a href="<?= base_url('admin/bookings') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/bookings') ? 'active' : '' ?>">
      <i class="fas fa-calendar-check"></i> Bookings
    </a>
    <a href="<?= base_url('admin/packages') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/packages') ? 'active' : '' ?>">
      <i class="fas fa-box"></i> Packages
    </a>
    <a href="<?= base_url('admin/blog') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/blog') ? 'active' : '' ?>">
      <i class="fas fa-newspaper"></i> Blog
    </a>
    <a href="<?= base_url('admin/hero') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/hero') ? 'active' : '' ?>">
      <i class="fas fa-panorama"></i> Hero
    </a>
    <a href="<?= base_url('admin/about') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/about') ? 'active' : '' ?>">
      <i class="fas fa-building"></i> About
    </a>
    <a href="<?= base_url('admin/awards') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/awards') ? 'active' : '' ?>">
      <i class="fas fa-award"></i> Awards
    </a>
    <a href="<?= base_url('admin/services') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/services') ? 'active' : '' ?>">
      <i class="fas fa-concierge-bell"></i> Services
    </a>
    <a href="<?= base_url('admin/testimonials') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/testimonials') ? 'active' : '' ?>">
      <i class="fas fa-quote-right"></i> Testimonials
    </a>
    <a href="<?= base_url('admin/team-members') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/team-members') ? 'active' : '' ?>">
      <i class="fas fa-users"></i> Team
    </a>
    <a href="<?= base_url('admin/timeline') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/timeline') ? 'active' : '' ?>">
      <i class="fas fa-timeline"></i> Timeline
    </a>
    <a href="<?= base_url('admin/sections') ?>" class="nav-item <?= str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/new/admin/sections') ? 'active' : '' ?>">
      <i class="fas fa-layer-group"></i> Sections
    </a>
    <div class="nav-section-label">System</div>
    <a href="<?= base_url('admin/settings') ?>" class="nav-item <?= is_current_path('/admin/settings') ? 'active' : '' ?>">
      <i class="fas fa-sliders"></i> Settings
    </a>
    <a href="<?= base_url('admin/logout') ?>" class="nav-item">
      <i class="fas fa-right-from-bracket"></i> Logout
    </a>
  </aside>

  <main class="main">
    <?php if (Session::has('_success')): ?>
      <div class="flash flash-success"><?= e(Session::get('_success')) ?><?php Session::remove('_success'); ?></div>
    <?php endif; ?>
    <?php if (Session::has('_error')): ?>
      <div class="flash flash-error"><?= e(Session::get('_error')) ?><?php Session::remove('_error'); ?></div>
    <?php endif; ?>
    <?= $content ?>
  </main>

</div>

</body>
</html>
