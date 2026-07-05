<div class="topbar">
  <div>
    <h1>Services</h1>
    <div class="topbar-date">Manage the services section cards</div>
  </div>
</div>

<div class="settings-group">
  <h2 class="settings-group-title">Service Cards</h2>
  <p style="font-size:13px;color:var(--muted);margin-bottom:12px">These cards appear in the full-screen scrolling services section. Drag to reorder? Add as many as you like.</p>

  <?php if (empty($services)): ?>
    <div class="panel-empty">No services yet. Add your first service below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($services as $s): ?>
      <div class="section-item">
        <div class="section-item-handle"><i class="fas fa-grip-lines"></i></div>
        <?php if ($s['image']):
          $src = str_starts_with($s['image'], 'http') ? $s['image'] : asset('storage/uploads/services/' . $s['image']);
        ?>
          <img src="<?= e($src) ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:6px;flex-shrink:0">
        <?php endif; ?>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($s['title'] ?: '(no title)') ?></strong>
            <span class="badge badge-muted"><?= e($s['tag']) ?></span>
            <?php if (!$s['active']): ?><span class="badge badge-danger">Inactive</span><?php endif; ?>
          </div>
          <div class="section-item-desc"><?= e(mb_substr(strip_tags($s['description']), 0, 80)) ?>...</div>
        </div>
        <div class="section-item-actions">
          <?php if ($s['active']): ?>
            <a href="<?= base_url('admin/services/toggle/' . (int) $s['id']) ?>" class="btn-sm btn-muted">Deactivate</a>
          <?php else: ?>
            <a href="<?= base_url('admin/services/toggle/' . (int) $s['id']) ?>" class="btn-sm btn-new">Activate</a>
          <?php endif; ?>
          <a href="<?= base_url('admin/services/delete/' . (int) $s['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this service?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New Service</h3>
  <form method="post" action="<?= base_url('admin/services/add') ?>" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:12px;max-width:600px">
    <?= csrf_field() ?>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Title</h4>
    <div class="locale-row" style="margin-bottom:0">
      <div class="locale-input"><label>EN</label><input type="text" name="title_en" placeholder="e.g. Umrah Packages" required></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="title_ps"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="title_fa"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Tag</h4>
    <div class="locale-row" style="margin-bottom:0">
      <div class="locale-input"><label>EN</label><input type="text" name="tag_en" placeholder="e.g. UMRAH"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="tag_ps"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="tag_fa"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Description</h4>
    <div class="locale-row" style="margin-bottom:0">
      <div class="locale-input"><label>EN</label><textarea name="description_en" rows="3" placeholder="Service description..."></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="description_ps" rows="3"></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="description_fa" rows="3"></textarea></div>
    </div>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Link URL</label>
        <input type="text" name="link" placeholder="/contact" value="/contact">
      </div>
      <div class="settings-field">
        <label>Image</label>
        <input type="file" name="image" accept="image/png,image/jpeg,image/webp" required>
      </div>
    </div>
    <button type="submit" class="btn-new" style="align-self:flex-start"><i class="fas fa-plus"></i> Add Service</button>
  </form>
</div>
