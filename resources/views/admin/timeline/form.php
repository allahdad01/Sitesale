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
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Year</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="year_en" value="<?= e($i['year_en'] ?? $i['year'] ?? '') ?>"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="year_ps" value="<?= e($i['year_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="year_fa" value="<?= e($i['year_fa'] ?? '') ?>"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Title</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="title_en" value="<?= e($i['title_en'] ?? $i['title'] ?? '') ?>"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="title_ps" value="<?= e($i['title_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="title_fa" value="<?= e($i['title_fa'] ?? '') ?>"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Description</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><textarea name="text_en" rows="4"><?= e($i['text_en'] ?? $i['text'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="text_ps" rows="4"><?= e($i['text_ps'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="text_fa" rows="4"><?= e($i['text_fa'] ?? '') ?></textarea></div>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> Update Milestone</button>
  </div>
</form>