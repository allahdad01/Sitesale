<div class="topbar">
  <div>
    <h1>Footer</h1>
    <div class="topbar-date">Edit column headings and tagline</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/footer/update') ?>">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Services Column</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Column Heading</label>
        <input type="text" name="footer_services_heading" value="<?= e(setting('footer_services_heading', 'Services')) ?>">
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Destinations Column</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Column Heading</label>
        <input type="text" name="footer_destinations_heading" value="<?= e(setting('footer_destinations_heading', 'Destinations')) ?>">
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Footer Bottom</h2>
    <div class="settings-grid">
      <div class="settings-field" style="max-width:100%">
        <label>Tagline (right side)</label>
        <input type="text" name="footer_tagline" value="<?= e(setting('footer_tagline', 'Certified Hajj &amp; Umrah Operator')) ?>">
      </div>
    </div>
  </div>

  <button type="submit" class="btn-new"><i class="fas fa-save"></i> Save All Changes</button>
</form>
