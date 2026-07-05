<?php $pkg = $pkg ?? null; ?>
<script>
function previewImage(input, previewId) {
  var preview = document.getElementById(previewId);
  if (!preview) return;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      preview.innerHTML = '<img src="' + e.target.result + '" alt="">';
      preview.className = 'image-preview';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
<div class="topbar">
  <div><h1><?= $pkg ? 'Edit' : 'Add' ?> Package</h1></div>
  <a href="<?= base_url('admin/packages') ?>" class="btn-new" style="background:var(--muted)"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form method="post" action="<?= $pkg ? base_url('admin/packages/update/' . (int) $pkg['id']) : base_url('admin/packages/store') ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Title</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><input type="text" name="title_en" value="<?= e($pkg['title_en'] ?? $pkg['title'] ?? '') ?>" required></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="title_ps" value="<?= e($pkg['title_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="title_fa" value="<?= e($pkg['title_fa'] ?? '') ?>"></div>
    </div>
    <h2 class="settings-group-title" style="margin-top:16px">Destination</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><input type="text" name="destination_en" value="<?= e($pkg['destination_en'] ?? $pkg['destination'] ?? '') ?>" placeholder="e.g. Saudi Arabia"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="destination_ps" value="<?= e($pkg['destination_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="destination_fa" value="<?= e($pkg['destination_fa'] ?? '') ?>"></div>
    </div>
  </div>

  <div class="settings-group">
    <div class="settings-grid">
      <div class="settings-field"><label>Slug (leave blank for auto)</label><input type="text" name="slug" value="<?= e($pkg['slug'] ?? '') ?>"></div>
      <div class="settings-field"><label>Category</label>
        <select name="category">
          <?php foreach (['umrah','hajj','tour','flight','visa','hotel'] as $c): ?>
            <option value="<?= $c ?>" <?= ($pkg['category'] ?? '') === $c ? 'selected' : '' ?>><?= ucfirst($c) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="settings-field"><label>Price ($)</label><input type="text" name="price" value="<?= e($pkg['price'] ?? '0') ?>"></div>
      <div class="settings-field"><label>Duration (days)</label><input type="number" name="duration_days" value="<?= (int) ($pkg['duration_days'] ?? 1) ?>"></div>
      <div class="settings-field"><label>Max people</label><input type="number" name="max_people" value="<?= (int) ($pkg['max_people'] ?? 1) ?>"></div>
      <div class="settings-field"><label>Featured</label>
        <select name="featured"><option value="1" <?= ($pkg['featured'] ?? 0) ? 'selected' : '' ?>>Yes</option><option value="0" <?= !($pkg['featured'] ?? 0) ? 'selected' : '' ?>>No</option></select>
      </div>
      <div class="settings-field"><label>Active</label>
        <select name="active"><option value="1" <?= ($pkg['active'] ?? 1) ? 'selected' : '' ?>>Yes</option><option value="0" <?= !($pkg['active'] ?? 1) ? 'selected' : '' ?>>No</option></select>
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Image</h2>
    <div class="settings-field">
      <div class="image-upload-wrap">
        <div class="image-preview <?= ($pkg && $pkg['image']) ? '' : 'image-preview-empty' ?>" id="imagePreview">
          <?php if ($pkg && $pkg['image']): ?>
            <img src="<?= asset('storage/uploads/' . e($pkg['image'])) ?>" alt="">
          <?php else: ?>
            <i class="fas fa-image"></i>
            <span>No image</span>
          <?php endif; ?>
        </div>
        <input type="file" name="image" accept="image/png,image/jpeg,image/webp" onchange="previewImage(this, 'imagePreview')">
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Description</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><textarea name="description_en" rows="8"><?= e($pkg['description_en'] ?? $pkg['description'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="description_ps" rows="8"><?= e($pkg['description_ps'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="description_fa" rows="8"><?= e($pkg['description_fa'] ?? '') ?></textarea></div>
    </div>
  </div>

  <button type="submit" class="btn-new" style="margin-top:16px"><i class="fas fa-save"></i> <?= $pkg ? 'Update' : 'Create' ?> Package</button>
</form>
