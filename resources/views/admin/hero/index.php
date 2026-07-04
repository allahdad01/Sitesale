<div class="topbar">
  <div>
    <h1>Hero Content</h1>
    <div class="topbar-date">Edit the hero banner — text, stats, and carousel slides</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/hero/update') ?>">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Hero Text</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Badge Text</label>
        <input type="text" name="hero_badge" value="<?= e(setting('hero_badge', 'Trusted Since 2010 · Hajj & Umrah Specialists')) ?>">
      </div>
      <div class="settings-field">
        <label>Title (HTML allowed)</label>
        <textarea name="hero_title" rows="3"><?= e(setting('hero_title', 'Your Sacred Journey<br><span class="orange">Begins Here</span>')) ?></textarea>
      </div>
      <div class="settings-field">
        <label>Subtitle</label>
        <textarea name="hero_subtitle" rows="3"><?= e(setting('hero_subtitle', 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences tailored for you.')) ?></textarea>
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Buttons</h2>
    <div class="settings-grid">
      <div class="settings-field"><label>Button 1 Text</label><input type="text" name="hero_btn1_text" value="<?= e(setting('hero_btn1_text', 'Explore Packages')) ?>"></div>
      <div class="settings-field"><label>Button 1 URL</label><input type="text" name="hero_btn1_url" value="<?= e(setting('hero_btn1_url', '/new/services')) ?>"></div>
      <div class="settings-field"><label>Button 2 Text</label><input type="text" name="hero_btn2_text" value="<?= e(setting('hero_btn2_text', 'View Destinations')) ?>"></div>
      <div class="settings-field"><label>Button 2 URL</label><input type="text" name="hero_btn2_url" value="<?= e(setting('hero_btn2_url', '/new/destinations')) ?>"></div>
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
        <div class="settings-field" style="flex:2">
          <label>Stat <?= $i ?> Label</label>
          <input type="text" name="hero_stat<?= $i ?>_label" value="<?= e(setting("hero_stat{$i}_label", ['Years Experience','Happy Pilgrims','Destinations','Visa Success'][$i-1])) ?>">
        </div>
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
  <form method="post" action="<?= base_url('admin/hero/slides/add') ?>" enctype="multipart/form-data" style="display:flex;gap:12px;align-items:end;flex-wrap:wrap">
    <?= csrf_field() ?>
    <div class="settings-field" style="flex:1;min-width:200px">
      <label>Label</label>
      <input type="text" name="label" placeholder="e.g. Dubai" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
    </div>
    <div class="settings-field" style="flex:1;min-width:200px">
      <label>Image</label>
      <input type="file" name="image" accept="image/png,image/jpeg,image/webp" required style="font-size:13px">
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add Slide</button>
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
