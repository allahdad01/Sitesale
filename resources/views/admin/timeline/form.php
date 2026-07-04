<?php $i = $item; ?>
<div class="topbar">
  <div>
    <h1>Edit Timeline Item</h1>
    <div class="topbar-date">Update milestone details</div>
  </div>
  <a href="<?= base_url('admin/timeline') ?>" class="btn-new" style="background:var(--muted)"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form method="post" action="<?= base_url('admin/timeline/update/' . (int) $i['id']) ?>" style="max-width:600px">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Milestone Details</h2>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field">
        <label>Year</label>
        <input type="text" name="year" value="<?= e($i['year'] ?? '') ?>" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
      </div>
      <div class="settings-field">
        <label>Title</label>
        <input type="text" name="title" value="<?= e($i['title'] ?? '') ?>" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
      </div>
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Description</label>
      <textarea name="text" rows="4" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px;resize:vertical"><?= e($i['text'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> Update Milestone</button>
  </div>
</form>