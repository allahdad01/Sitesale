<div class="topbar">
  <div>
    <h1>Timeline</h1>
    <div class="topbar-date">Manage timeline milestones displayed on the About page</div>
  </div>
</div>

<div class="settings-group">
  <h2 class="settings-group-title">All Milestones</h2>

  <?php if (empty($items)): ?>
    <div class="panel-empty">No timeline items yet. Add one below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($items as $i): ?>
      <div class="section-item">
        <div class="section-item-handle"><i class="fas fa-grip-lines"></i></div>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($i['year'] ?: '(no year)') ?> — <?= e($i['title'] ?: '(no title)') ?></strong>
            <?php if (!$i['active']): ?><span class="badge badge-danger">Inactive</span><?php endif; ?>
          </div>
          <div class="section-item-desc"><?= e(mb_substr($i['text'] ?? '', 0, 100)) ?>&hellip;</div>
        </div>
        <div class="section-item-actions">
          <a href="<?= base_url('admin/timeline/edit/' . (int) $i['id']) ?>" class="btn-sm btn-outline">Edit</a>
          <?php if ($i['active']): ?>
            <a href="<?= base_url('admin/timeline/toggle/' . (int) $i['id']) ?>" class="btn-sm btn-muted">Deactivate</a>
          <?php else: ?>
            <a href="<?= base_url('admin/timeline/toggle/' . (int) $i['id']) ?>" class="btn-sm btn-new">Activate</a>
          <?php endif; ?>
          <a href="<?= base_url('admin/timeline/delete/' . (int) $i['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this milestone?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New Milestone</h3>
  <form method="post" action="<?= base_url('admin/timeline/add') ?>" style="max-width:600px">
    <?= csrf_field() ?>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field">
        <label>Year</label>
        <input type="text" name="year" placeholder="e.g. 2010" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
      </div>
      <div class="settings-field">
        <label>Title</label>
        <input type="text" name="title" placeholder="e.g. Founded in Kabul" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
      </div>
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Description</label>
      <textarea name="text" rows="3" placeholder="Milestone description..." style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px;resize:vertical"></textarea>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add Milestone</button>
  </form>
</div>