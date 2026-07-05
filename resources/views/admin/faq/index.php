<div class="topbar">
  <div>
    <h1>FAQ</h1>
    <div class="topbar-date">Manage frequently asked questions displayed on the contact page</div>
  </div>
</div>

<div class="settings-group">
  <h2 class="settings-group-title">All Questions</h2>

  <?php if (empty($faqs)): ?>
    <div class="panel-empty">No FAQs yet. Add one below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($faqs as $f): ?>
      <div class="section-item">
        <div class="section-item-handle"><i class="fas fa-grip-lines"></i></div>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($f['question']) ?></strong>
          </div>
          <div style="font-size:13px;color:var(--muted);margin-top:4px;line-height:1.5">
            <?= e(mb_strlen($f['answer']) > 120 ? mb_substr($f['answer'], 0, 120) . '&hellip;' : $f['answer']) ?>
          </div>
        </div>
        <div class="section-item-actions">
          <a href="<?= base_url('admin/faq/delete/' . (int) $f['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this FAQ?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New FAQ</h3>
  <form method="post" action="<?= base_url('admin/faq/add') ?>" style="max-width:600px">
    <?= csrf_field() ?>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Question</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="question_en" placeholder="e.g. What documents do I need for Umrah?" required></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="question_ps"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="question_fa"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Answer</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><textarea name="answer_en" rows="4" placeholder="Write the answer..." required></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="answer_ps" rows="4"></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="answer_fa" rows="4"></textarea></div>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add FAQ</button>
  </form>
</div>
