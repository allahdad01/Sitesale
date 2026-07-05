<div class="topbar">
  <div>
    <h1>Hero Content</h1>
    <div class="topbar-date">Edit the hero banner — text, stats, and carousel slides</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/hero/update') ?>">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Hero Badge</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><input type="text" name="hero_badge" value="<?= e(setting('hero_badge', 'Trusted Since 2010 · Hajj & Umrah Specialists')) ?>"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="hero_badge_ps" value="<?= e(setting('hero_badge_ps', '')) ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="hero_badge_fa" value="<?= e(setting('hero_badge_fa', '')) ?>"></div>
    </div>
    <h2 class="settings-group-title" style="margin-top:16px">Title (HTML allowed)</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><textarea name="hero_title" rows="3"><?= e(setting('hero_title', 'Your Sacred Journey<br><span class="orange">Begins Here</span>')) ?></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="hero_title_ps" rows="3"><?= e(setting('hero_title_ps', '')) ?></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="hero_title_fa" rows="3"><?= e(setting('hero_title_fa', '')) ?></textarea></div>
    </div>
    <h2 class="settings-group-title" style="margin-top:16px">Subtitle</h2>
    <div class="locale-row">
      <div class="locale-input"><label>EN</label><textarea name="hero_subtitle" rows="3"><?= e(setting('hero_subtitle', 'Premium Hajj & Umrah packages...')) ?></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="hero_subtitle_ps" rows="3"><?= e(setting('hero_subtitle_ps', '')) ?></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="hero_subtitle_fa" rows="3"><?= e(setting('hero_subtitle_fa', '')) ?></textarea></div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Buttons</h2>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Button 1 Text</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="hero_btn1_text" value="<?= e(setting('hero_btn1_text', 'Explore Packages')) ?>"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="hero_btn1_text_ps" value="<?= e(setting('hero_btn1_text_ps', '')) ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="hero_btn1_text_fa" value="<?= e(setting('hero_btn1_text_fa', '')) ?>"></div>
    </div>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field"><label>Button 1 URL</label><input type="text" name="hero_btn1_url" value="<?= e(setting('hero_btn1_url', '#services')) ?>"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Button 2 Text</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="hero_btn2_text" value="<?= e(setting('hero_btn2_text', 'View Destinations')) ?>"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="hero_btn2_text_ps" value="<?= e(setting('hero_btn2_text_ps', '')) ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="hero_btn2_text_fa" value="<?= e(setting('hero_btn2_text_fa', '')) ?>"></div>
    </div>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field"><label>Button 2 URL</label><input type="text" name="hero_btn2_url" value="<?= e(setting('hero_btn2_url', '#destinations')) ?>"></div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Stats Bar</h2>
    <div class="settings-grid">
      <?php for ($i = 1; $i <= 4; $i++): ?>
      <div style="display:flex;gap:8px;align-items:end">
        <div class="settings-field" style="flex:1">
          <label>Stat <?= $i ?> Number</label>
          <input type="text" name="hero_stat<?= $i ?>_num" value="<?= e(setting("hero_stat{$i}_num", ['20+','50K+','30+','100%'][$i-1])) ?>">
        </div>
      </div>
      <div style="display:flex;gap:8px;align-items:end;grid-column:1/-1">
        <div class="settings-field" style="flex:1"><label>Stat <?= $i ?> Label (EN)</label><input type="text" name="hero_stat<?= $i ?>_label" value="<?= e(setting("hero_stat{$i}_label", ['Years Experience','Happy Pilgrims','Destinations','Visa Success'][$i-1])) ?>"></div>
        <div class="settings-field" style="flex:1"><label>(پښتو)</label><input type="text" name="hero_stat<?= $i ?>_label_ps" value="<?= e(setting("hero_stat{$i}_label_ps", '')) ?>"></div>
        <div class="settings-field" style="flex:1"><label>(دری)</label><input type="text" name="hero_stat<?= $i ?>_label_fa" value="<?= e(setting("hero_stat{$i}_label_fa", '')) ?>"></div>
      </div>
      <?php endfor; ?>
    </div>
  </div>

  <button type="submit" class="btn-new" style="margin-bottom:24px"><i class="fas fa-save"></i> Save Hero Text & Stats</button>
</form>

<div class="settings-group">
  <h2 class="settings-group-title">Carousel Slides</h2>
  <p style="font-size:13px;color:var(--muted);margin-bottom:12px">These slides circle around the center Kaaba image. Drag to reorder? Add as many as you like.</p>

  <?php if (empty($slides)): ?>
    <div class="panel-empty">No slides yet. Add your first slide below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($slides as $s): ?>
      <div class="section-item">
        <div class="section-item-handle"><i class="fas fa-grip-lines"></i></div>
        <?php if ($s['image']):
          $src = str_starts_with($s['image'], 'http') ? $s['image'] : asset('storage/uploads/hero/' . $s['image']);
        ?>
          <img src="<?= e($src) ?>" alt="" style="width:60px;height:60px;object-fit:cover;border-radius:6px;flex-shrink:0">
        <?php endif; ?>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($s['label'] ?: '(no label)') ?></strong>
          </div>
        </div>
        <div class="section-item-actions">
          <a href="<?= base_url('admin/hero/slides/delete/' . (int) $s['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this slide?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New Slide</h3>
  <form method="post" action="<?= base_url('admin/hero/slides/add') ?>" enctype="multipart/form-data" style="display:flex;flex-direction:column;gap:12px;max-width:500px">
    <?= csrf_field() ?>
    <h4 style="font-size:13px;margin:0;color:var(--navy)">Label</h4>
    <div class="locale-row" style="margin-bottom:0">
      <div class="locale-input"><label>EN</label><input type="text" name="label_en" placeholder="e.g. Dubai"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="label_ps"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="label_fa"></div>
    </div>
    <div style="display:flex;gap:12px;align-items:end">
      <div class="settings-field" style="flex:1">
        <label>Image</label>
        <input type="file" name="image" accept="image/png,image/jpeg,image/webp" required>
      </div>
      <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add Slide</button>
    </div>
  </form>
</div>

<div class="settings-group">
  <h2 class="settings-group-title">Center Image (Kaaba)</h2>
  <p style="font-size:13px;color:var(--muted);margin-bottom:8px">This image sits at the center of the carousel.</p>
  <form method="post" action="<?= base_url('admin/hero/update') ?>">
    <?= csrf_field() ?>
    <?php $kaaba = setting('hero_kaaba_img', ''); ?>
    <div class="image-upload-wrap" style="max-width:400px">
      <div class="image-preview <?= $kaaba ? '' : 'image-preview-empty' ?>" id="preview_kaaba" style="width:100%;height:120px">
        <?php if ($kaaba): ?>
          <img src="<?= asset('storage/uploads/hero/' . e($kaaba)) ?>" alt="" style="object-fit:cover">
        <?php else: ?>
          <i class="fas fa-image"></i><span>No image</span>
        <?php endif; ?>
      </div>
      <input type="file" name="hero_kaaba_img_file" accept="image/png,image/jpeg,image/webp" onchange="previewImage(this, 'preview_kaaba')" style="font-size:13px">
    </div>
    <button type="submit" class="btn-new" style="margin-top:10px"><i class="fas fa-save"></i> Update Kaaba Image</button>
  </form>
</div>

<script>
function previewImage(input, previewId) {
  var preview = document.getElementById(previewId);
  if (!preview) return;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      preview.innerHTML = '<img src="' + e.target.result + '" alt="" style="object-fit:cover">';
      preview.className = 'image-preview';
    };
    reader.readAsDataURL(input.files[0]);
  }
}
</script>
