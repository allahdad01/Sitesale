<?php use App\Core\View;
  $pages = [
    'home'         => base_url(),
    'packages'     => base_url('packages'),
    'services'     => base_url('services'),
    'destinations' => base_url('destinations'),
    'blog'         => base_url('blog'),
    'about'        => base_url('about'),
  ];
  $current = $current_page ?? '';
function isActive(string $page, string $current): string {
  return $page === $current ? 'active-link' : '';
}
?>
<nav>
  <div class="nav-logo">
    <a href="<?= base_url() ?>" style="display:flex;align-items:center;gap:12px;text-decoration:none;">
      <?php $logoImg = setting('logo_image', ''); if ($logoImg): ?>
        <img src="<?= asset('storage/uploads/' . e($logoImg)) ?>" alt="<?= e(setting('logo_text', 'Al Moqadas')) ?>" style="height:40px;width:auto;border-radius:6px;">
      <?php else: ?>
        <div class="logo-emblem"><i class="fas <?= e(setting('logo_icon', 'fa-mosque')) ?>"></i></div>
      <?php endif; ?>
      <h2><?= e(setting('logo_text', 'Al Moqadas')) ?></h2>
    </a>
  </div>
  <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation menu" aria-expanded="false">
    <i class="fas fa-bars"></i>
  </button>
  <ul class="nav-links" id="navLinks">
    <?php foreach ($pages as $page => $path): ?>
      <li><a href="<?= e($path) ?>" class="<?= isActive($page, $current) ?>"><?= e(ucfirst($page)) ?></a></li>
    <?php endforeach; ?>
    <li><a href="<?= base_url('packages') ?>" class="nav-cta <?= isActive('packages', $current) ?>">Book Now</a></li>
  </ul>
</nav>
