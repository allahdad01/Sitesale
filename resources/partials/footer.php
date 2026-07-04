<?php use App\Core\View; ?>
<footer>
  <div class="footer-inner">
    <div class="footer-brand">
      <h2>
        <?php $logoImg = setting('logo_image', ''); if ($logoImg): ?>
          <img src="<?= asset('storage/uploads/' . e($logoImg)) ?>" alt="<?= e(setting('logo_text', 'Al Moqadas')) ?>" style="height:32px;width:auto;border-radius:6px;vertical-align:middle;margin-right:10px;">
        <?php else: ?>
          <span class="footer-logo-icon"><i class="fas <?= e(setting('logo_icon', 'fa-mosque')) ?>"></i></span>
        <?php endif; ?>
        <?= e(setting('logo_text', 'Al Moqadas')) ?>
      </h2>
      <p><?= e(setting('footer_description', 'Your trusted partner for Hajj, Umrah, and worldwide travel since 2010. Serving pilgrims and travelers with care, integrity, and excellence.')) ?></p>
      <div class="footer-socials">
        <a class="social-btn" href="<?= e(setting('social_facebook', '#')) ?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a class="social-btn" href="<?= e(setting('social_linkedin', '#')) ?>" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
        <a class="social-btn" href="<?= e(setting('social_twitter', '#')) ?>" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
        <a class="social-btn" href="https://wa.me/<?= e(setting('whatsapp_number', '93700000000')) ?>" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>
    <div class="footer-col">
      <h4>Services</h4>
      <ul>
        <li><a href="<?= base_url('packages') ?>">All Packages</a></li>
        <li><a href="<?= base_url('packages?category=umrah') ?>">Umrah Packages</a></li>
        <li><a href="<?= base_url('packages?category=hajj') ?>">Hajj Packages</a></li>
        <li><a href="<?= base_url('packages?category=flight') ?>">Flight Booking</a></li>
        <li><a href="<?= base_url('packages?category=visa') ?>">Visa Services</a></li>
        <li><a href="<?= base_url('packages?category=hotel') ?>">Hotel Reservations</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>Destinations</h4>
      <ul>
        <li><a href="<?= base_url('destinations') ?>">Mecca & Medina</a></li>
        <li><a href="<?= base_url('destinations') ?>">Dubai</a></li>
        <li><a href="<?= base_url('destinations') ?>">Istanbul</a></li>
        <li><a href="<?= base_url('destinations') ?>">Malaysia</a></li>
        <li><a href="<?= base_url('blog') ?>">Our Blog</a></li>
        <li><a href="<?= base_url('about') ?>">About Us</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <span>&copy; <?= date('Y') ?> <?= e(setting('footer_copyright', 'Al Moqadas Travel Agency')) ?> &middot; All Rights Reserved</span>
    <span>Certified Hajj &amp; Umrah Operator</span>
  </div>
</footer>
