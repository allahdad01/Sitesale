<?php
function initials(string $name): string {
    $parts = explode(' ', $name);
    $init = '';
    foreach ($parts as $p) {
        if ($p !== '') $init .= strtoupper(mb_substr($p, 0, 1));
    }
    return $init ?: '?';
}
?>
<div class="topbar">
  <div>
    <h1>Testimonials</h1>
    <div class="topbar-date">Manage client testimonials displayed on the home page</div>
  </div>
</div>

<div class="settings-group">
  <h2 class="settings-group-title">All Testimonials</h2>

  <?php if (empty($testimonials)): ?>
    <div class="panel-empty">No testimonials yet. Add one below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($testimonials as $t): ?>
      <div class="section-item">
        <div class="section-item-avatar" style="width:44px;height:44px;border-radius:50%;background:var(--primary);color:var(--white);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:14px;flex-shrink:0;overflow:hidden">
          <?php if (!empty($t['avatar'])): ?>
            <img src="<?= asset('storage/uploads/testimonials/' . e($t['avatar'])) ?>" alt="" style="width:100%;height:100%;object-fit:cover">
          <?php else: ?>
            <?= e(initials($t['name'])) ?>
          <?php endif; ?>
        </div>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($t['name']) ?></strong>
            <span style="font-size:12px;color:var(--muted);margin-left:8px"><?= e($t['position'] ?: '') ?></span>
          </div>
          <div style="font-size:12px;color:#eab308;margin-top:2px">
            <?php for ($r = 0; $r < (int)($t['rating'] ?? 5); $r++): ?><i class="fas fa-star"></i><?php endfor; ?>
          </div>
          <div style="font-size:13px;color:var(--muted);margin-top:4px;line-height:1.5">
            &ldquo;<?= e(mb_strlen($t['content']) > 120 ? mb_substr($t['content'], 0, 120) . '&hellip;' : $t['content']) ?>&rdquo;
          </div>
        </div>
        <div class="section-item-actions">
          <a href="<?= base_url('admin/testimonials/delete/' . (int) $t['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this testimonial?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New Testimonial</h3>
  <form method="post" action="<?= base_url('admin/testimonials/add') ?>" enctype="multipart/form-data" style="max-width:600px">
    <?= csrf_field() ?>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Name</label>
      <input type="text" name="name" placeholder="e.g. Ahmad Karimi" required style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Position / Location</label>
      <input type="text" name="position" placeholder="e.g. Umrah Pilgrim · Kabul" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Rating</label>
      <select name="rating" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
        <option value="5">5 Stars</option>
        <option value="4">4 Stars</option>
        <option value="3">3 Stars</option>
        <option value="2">2 Stars</option>
        <option value="1">1 Star</option>
      </select>
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Avatar Image (optional)</label>
      <input type="file" name="avatar" accept="image/png,image/jpeg,image/webp" style="font-size:13px">
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Testimonial Text</label>
      <textarea name="content" rows="4" placeholder="What did the client say?" required style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px;resize:vertical"></textarea>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add Testimonial</button>
  </form>
</div>
