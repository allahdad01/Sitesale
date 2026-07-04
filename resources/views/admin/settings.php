<?php
$fallbacks = [
    'site_name'          => 'Al Moqadas Travel Agency',
    'site_tagline'       => 'Your Sacred Journey Begins Here',
    'logo_text'          => 'Al Moqadas',
    'logo_icon'          => 'fa-mosque',
    'logo_image'         => '',
    'favicon'            => '',
    'color_primary'      => '#FE590B',
    'color_primary_dark' => '#d44500',
    'color_primary_light' => '#ff7a38',
    'color_navy'         => '#2A2A68',
    'color_navy_dark'    => '#1e1e50',
    'color_navy_light'   => '#38388a',
    'color_bg'           => '#D3D3D3',
    'color_bg2'          => '#bebebe',
    'contact_phone'      => '+93 700 000 000',
    'contact_email'      => 'info@almoqadas.com',
    'contact_address'    => 'Kabul, Afghanistan',
    'whatsapp_number'    => '93700000000',
    'social_facebook'    => '#',
    'social_twitter'     => '#',
    'social_linkedin'    => '#',
    'social_instagram'   => '',
    'hero_title'         => 'Your Sacred Journey<br><span class="orange">Begins Here</span>',
    'hero_subtitle'      => 'Premium Hajj &amp; Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.',
    'footer_description' => 'Your trusted partner for Hajj, Umrah, and worldwide travel since 2010. Serving pilgrims and travelers with care, integrity, and excellence.',
    'footer_copyright'   => 'Al Moqadas Travel Agency',
    'meta_description'   => 'Premium Hajj &amp; Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.',
    'meta_keywords'      => 'Hajj, Umrah, travel agency, flights, visa, Afghanistan',
    'google_analytics_id' => '',
];
?>
<div class="topbar">
  <div>
    <h1>Platform Settings</h1>
    <div class="topbar-date">Control everything on the site — brand, colors, content &amp; more</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/settings') ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <?php foreach ($groups as $gid => $group): ?>
  <div class="settings-group">
    <h2 class="settings-group-title"><?= e($group['label']) ?></h2>
    <div class="settings-grid">
      <?php foreach ($group['keys'] as $key): ?>
        <?php
          $val = $settings[$key] ?? $fallbacks[$key] ?? '';
          $isColor = str_starts_with($key, 'color_');
          $isImage = in_array($key, $imageKeys);
          $isTextarea = in_array($key, ['hero_title', 'hero_subtitle', 'footer_description', 'meta_description']);
        ?>
        <div class="settings-field">
          <label for="s_<?= $key ?>"><?= e($key) ?></label>

          <?php if ($isImage): ?>
            <div class="image-upload-wrap">
              <?php if (!empty($val)): ?>
                <div class="image-preview">
                  <img src="<?= asset('storage/uploads/' . e($val)) ?>" alt="<?= e($key) ?> preview">
                  <button type="submit" name="_remove_image" value="<?= e($key) ?>" class="image-remove-btn" title="Remove image">&times;</button>
                </div>
              <?php else: ?>
                <div class="image-preview image-preview-empty">
                  <i class="fas fa-image"></i>
                  <span>No image uploaded</span>
                </div>
              <?php endif; ?>
              <input type="file" id="s_<?= $key ?>" name="<?= e($key) ?>_file" accept="image/png,image/jpeg,image/gif,image/webp,image/svg+xml,image/x-icon">
              <input type="hidden" name="<?= e($key) ?>" value="<?= e($val) ?>">
            </div>

          <?php elseif ($isColor): ?>
            <div class="color-wrap">
              <input type="color" id="s_<?= $key ?>" name="<?= e($key) ?>" value="<?= e($val) ?>">
              <input type="text" class="color-text" value="<?= e($val) ?>" data-target="s_<?= $key ?>" readonly>
            </div>

          <?php elseif ($isTextarea): ?>
            <textarea id="s_<?= $key ?>" name="<?= e($key) ?>" rows="3"><?= e($val) ?></textarea>

          <?php else: ?>
            <input type="text" id="s_<?= $key ?>" name="<?= e($key) ?>" value="<?= e($val) ?>">
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>

  <div style="margin-top: 24px;">
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> Save All Settings</button>
  </div>
</form>

<script>
document.querySelectorAll('.color-text').forEach(function (txt) {
  txt.addEventListener('click', function () {
    var target = document.getElementById(this.dataset.target);
    if (target) { target.click(); }
  });
});
document.querySelectorAll('input[type="color"]').forEach(function (picker) {
  picker.addEventListener('input', function () {
    var txt = this.parentElement.querySelector('.color-text');
    if (txt) { txt.value = this.value; }
  });
});
// preview image on file select
document.querySelectorAll('input[type="file"]').forEach(function (input) {
  input.addEventListener('change', function () {
    if (this.files && this.files[0]) {
      var reader = new FileReader();
      reader.onload = function (e) {
        var preview = this.closest('.image-upload-wrap').querySelector('.image-preview');
        if (preview) {
          preview.innerHTML = '<img src="' + e.target.result + '" alt="preview">';
        }
      }.bind(this);
      reader.readAsDataURL(this.files[0]);
    }
  });
});
</script>
