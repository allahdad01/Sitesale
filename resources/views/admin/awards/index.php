<div class="topbar">
  <div>
    <h1>Awards & Recognition</h1>
    <div class="topbar-date">Edit the awards section — text and award logos</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/awards/update') ?>">
  <?= csrf_field() ?>
  <div class="settings-group">
    <h2 class="settings-group-title">Awards Text</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Badge Text</label>
        <input type="text" name="awards_badge" value="<?= e(setting('awards_badge', 'Recognition & Trust')) ?>">
      </div>
      <div class="settings-field">
        <label>Title (HTML allowed)</label>
        <input type="text" name="awards_title" value="<?= e(setting('awards_title', 'Honors & <span class="orange">Accolades</span>')) ?>">
      </div>
      <div class="settings-field">
        <label>Subtitle</label>
        <textarea name="awards_subtitle" rows="3"><?= e(setting('awards_subtitle', 'Recognized by leading industry organizations for our trusted service and excellence.')) ?></textarea>
      </div>
    </div>
    <button type="submit" class="btn-new" style="margin-top:16px"><i class="fas fa-save"></i> Save Text</button>
  </div>
</form>

<div class="settings-group">
  <h2 class="settings-group-title">Award Logos</h2>
  <p style="font-size:13px;color:var(--muted);margin-bottom:12px">These logos circle around the center award emblem. Upload your partnership logos and certificates.</p>

  <?php if (empty($awards)): ?>
    <div class="panel-empty">No awards yet. Add one below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($awards as $a): ?>
      <div class="section-item">
        <div class="section-item-handle"><i class="fas fa-grip-lines"></i></div>
        <?php if ($a['image']): ?>
          <img src="<?= asset('storage/uploads/awards/' . e($a['image'])) ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:6px;flex-shrink:0">
        <?php endif; ?>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($a['label'] ?: '(no label)') ?></strong>
          </div>
        </div>
        <div class="section-item-actions">
          <a href="<?= base_url('admin/awards/delete/' . (int) $a['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this award?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New Award</h3>
  <form method="post" action="<?= base_url('admin/awards/add') ?>" enctype="multipart/form-data" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap">
    <?= csrf_field() ?>
    <div class="settings-field" style="flex:1;min-width:200px">
      <label>Label</label>
      <input type="text" name="label" placeholder="e.g. Kam Air Award 2020" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
    </div>
    <div class="settings-field" style="flex:1;min-width:200px">
      <label>Image</label>
      <input type="file" name="image" accept="image/png,image/jpeg,image/webp" required style="font-size:13px">
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add Award</button>
  </form>
</div>
