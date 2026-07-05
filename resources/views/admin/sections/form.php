<?php $sec = $section; ?>
<div class="topbar">
  <div>
    <h1><?= $sec ? 'Edit Section' : 'Add Section' ?></h1>
    <div class="topbar-date"><?= $sec ? 'Update section details' : 'Create a new home page section' ?></div>
  </div>
  <a href="<?= base_url('admin/sections') ?>" class="btn-new" style="background:var(--muted)"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form method="post" action="<?= $sec ? base_url('admin/sections/update/' . (int) $sec['id']) : base_url('admin/sections/store') ?>">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Section Details</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label for="label">Label (admin name)</label>
        <input type="text" id="label" name="label" value="<?= e($sec['label'] ?? '') ?>" required>
      </div>
      <div class="settings-field">
        <label for="type">Type</label>
        <select id="type" name="type" <?= $sec && $sec['type'] === 'builtin' ? 'disabled' : '' ?>>
          <option value="custom_html" <?= $sec && $sec['type'] === 'custom_html' ? 'selected' : '' ?>>Custom HTML</option>
          <option value="builtin" <?= $sec && $sec['type'] === 'builtin' ? 'selected' : '' ?>>Built-in</option>
        </select>
        <?php if ($sec && $sec['type'] === 'builtin'): ?>
          <input type="hidden" name="type" value="builtin">
          <p style="font-size:12px;color:var(--muted);margin-top:4px">Built-in sections cannot change type.</p>
        <?php endif; ?>
      </div>
      <div class="settings-field">
        <label for="section_key">Key (identifier)</label>
        <input type="text" id="section_key" name="section_key" value="<?= e($sec['section_key'] ?? '') ?>" <?= $sec ? 'readonly' : '' ?>>
        <?php if (!$sec): ?>
          <p style="font-size:12px;color:var(--muted);margin-top:4px">Leave empty for auto-generated key.</p>
        <?php endif; ?>
      </div>
      <div class="settings-field">
        <label for="active">Active</label>
        <select id="active" name="active">
          <option value="1" <?= ($sec && $sec['active']) ? 'selected' : '' ?>>Active</option>
          <option value="0" <?= ($sec && !$sec['active']) ? 'selected' : '' ?>>Inactive</option>
        </select>
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Label (admin name)</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><input type="text" name="label_en" value="<?= e($sec['label_en'] ?? $sec['label'] ?? '') ?>" required></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="label_ps" value="<?= e($sec['label_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="label_fa" value="<?= e($sec['label_fa'] ?? '') ?>"></div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">HTML Content <small>(for custom sections)</small></h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><textarea name="content_en" rows="12"><?= e($sec['content_en'] ?? $sec['content'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="content_ps" rows="12"><?= e($sec['content_ps'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="content_fa" rows="12"><?= e($sec['content_fa'] ?? '') ?></textarea></div>
    </div>
  </div>

  <div style="margin-top:24px">
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> <?= $sec ? 'Update' : 'Create' ?> Section</button>
  </div>
</form>
