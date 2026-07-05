<?php use App\Core\View;
  $pages = [
    'home'         => base_url(),
    'packages'     => base_url('packages'),
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
  <button class="nav-toggle" id="navToggle" aria-label="<?= __('nav.toggle_menu') ?>" aria-expanded="false">
    <i class="fas fa-bars"></i>
  </button>
  <ul class="nav-links" id="navLinks">
    <?php foreach ($pages as $page => $path): ?>
      <li><a href="<?= e($path) ?>" class="<?= isActive($page, $current) ?>"><?= __('nav.' . $page) ?></a></li>
    <?php endforeach; ?>
    <li class="nav-lang-switcher">
      <select id="langSelect" onchange="window.location.href=this.value" aria-label="Language">
        <option value="<?= base_url('lang/en') ?>" <?= ($_SESSION['_locale'] ?? 'en') === 'en' ? 'selected' : '' ?>>English</option>
        <option value="<?= base_url('lang/ps') ?>" <?= ($_SESSION['_locale'] ?? '') === 'ps' ? 'selected' : '' ?>>پښتو</option>
        <option value="<?= base_url('lang/fa') ?>" <?= ($_SESSION['_locale'] ?? '') === 'fa' ? 'selected' : '' ?>>دری</option>
      </select>
    </li>
    <li><a href="<?= base_url('packages') ?>" class="nav-cta <?= isActive('packages', $current) ?>"><?= __('nav.book_now') ?></a></li>
  </ul>
</nav>
