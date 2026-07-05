<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-exclamation-triangle"></i> <?= __('error.404_title') ?></div>

  <h1><?= __('error.404_heading') ?></h1>

  <p class="hero-sub"><?= __('error.404_desc') ?></p>

  <div class="hero-buttons">
    <a href="<?= base_url() ?>" class="btn-primary"><?= __('error.404_btn') ?></a>
    <a href="<?= base_url('contact') ?>" class="btn-outline"><?= __('error.contact_btn') ?></a>
  </div>
</section>
