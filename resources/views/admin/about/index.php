<div class="topbar">
  <div>
    <h1>About Page</h1>
    <div class="topbar-date">Manage all About page content — sections, text, stats, timeline, team &amp; more</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/about/update') ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>

  <!-- Hero -->
  <div class="settings-group">
    <h2 class="settings-group-title">Hero Section</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Badge Text</label>
        <input type="text" name="about_hero_badge" value="<?= e(setting('about_hero_badge', 'Our Story Since 2010')) ?>">
      </div>
      <div class="settings-field">
        <label>Title <small>(HTML allowed)</small></label>
        <input type="text" name="about_hero_title" value="<?= e(setting('about_hero_title', 'Guiding Hearts To<br><span class="orange">Sacred Places</span>')) ?>">
      </div>
      <div class="settings-field">
        <label>Subtitle</label>
        <textarea name="about_hero_subtitle" rows="3"><?= e(setting('about_hero_subtitle', 'For over two decades, Al Moqadas has walked beside thousands of pilgrims and travelers — turning every journey into an experience of faith, comfort, and trust.')) ?></textarea>
      </div>
    </div>
  </div>

  <!-- Intro -->
  <div class="settings-group">
    <h2 class="settings-group-title">Intro Section</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Tag</label>
        <input type="text" name="about_intro_tag" value="<?= e(setting('about_intro_tag', 'Who We Are')) ?>">
      </div>
      <div class="settings-field">
        <label>Title</label>
        <input type="text" name="about_intro_title" value="<?= e(setting('about_intro_title', 'A Journey Built On Faith & Service')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Intro Image</label>
        <?php $introImg = setting('about_intro_image', ''); ?>
        <div class="image-upload-wrap">
          <?php if ($introImg): ?>
            <div class="image-preview">
              <img src="<?= asset('storage/uploads/' . e($introImg)) ?>" alt="Intro image preview">
              <button type="submit" name="_remove_image" value="about_intro_image" class="image-remove-btn" title="Remove image">&times;</button>
            </div>
          <?php else: ?>
            <div class="image-preview image-preview-empty">
              <i class="fas fa-image"></i>
              <span>No image uploaded</span>
            </div>
          <?php endif; ?>
          <input type="file" name="about_intro_image_file" accept="image/png,image/jpeg,image/webp">
          <input type="hidden" name="about_intro_image" value="<?= e($introImg) ?>">
        </div>
      </div>
      <div class="settings-field">
        <label>Badge (overlay on image)</label>
        <input type="text" name="about_intro_badge" value="<?= e(setting('about_intro_badge', '20+ Years of Trust')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Content <small>(separate paragraphs with a blank line)</small></label>
        <textarea name="about_intro_text" rows="6" style="width:100%"><?= e(setting('about_intro_text', "Al Moqadas Travel Agency was founded in Kabul with a single purpose: to make the sacred journeys of Hajj and Umrah accessible, comfortable, and worry-free for every Afghan family.\n\nWhat began as a small office helping neighbors book their first pilgrimage has grown into a full-service travel house — handling flights, visas, hotels, and tours across more than 30 destinations worldwide.\n\nThrough every chapter, our promise has stayed the same: treat every traveler like family, and handle every detail like it's our own pilgrimage.")) ?></textarea>
      </div>
    </div>
  </div>

  <!-- Stats -->
  <div class="settings-group">
    <h2 class="settings-group-title">Stats Section</h2>
    <p style="font-size:13px;color:var(--muted);margin-bottom:12px">Four statistics displayed in a row.</p>
    <div class="settings-grid">
      <?php for ($i = 1; $i <= 4; $i++):
        $defaults = ['20+','50K+','30+','100%'];
        $labels   = ['Years Experience','Happy Pilgrims','Destinations','Visa Success'];
      ?>
      <div class="settings-field">
        <label>Stat <?= $i ?> — Number</label>
        <input type="text" name="about_stat<?= $i ?>_num" value="<?= e(setting("about_stat{$i}_num", $defaults[$i-1])) ?>">
        <label style="margin-top:8px">Stat <?= $i ?> — Label</label>
        <input type="text" name="about_stat<?= $i ?>_label" value="<?= e(setting("about_stat{$i}_label", $labels[$i-1])) ?>">
      </div>
      <?php endfor; ?>
    </div>
  </div>

  <!-- Mission / Vision / Values -->
  <div class="settings-group">
    <h2 class="settings-group-title">Mission, Vision &amp; Values</h2>
    <div class="settings-grid">
      <div class="settings-field" style="max-width:100%">
        <label>Section Tag</label>
        <input type="text" name="about_section_tag" value="<?= e(setting('about_section_tag', 'What Drives Us')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Title</label>
        <input type="text" name="about_section_title" value="<?= e(setting('about_section_title', 'Mission, Vision & Values')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Description</label>
        <textarea name="about_section_desc" rows="2" style="width:100%"><?= e(setting('about_section_desc', 'The principles that guide every package we plan and every traveler we serve.')) ?></textarea>
      </div>
    </div>
    <div class="settings-grid" style="margin-top:16px">
      <div class="settings-field">
        <label>Mission — Title</label>
        <input type="text" name="about_mission_title" value="<?= e(setting('about_mission_title', 'Our Mission')) ?>">
        <label style="margin-top:8px">Mission — Text</label>
        <textarea name="about_mission_text" rows="3" style="width:100%"><?= e(setting('about_mission_text', 'To deliver safe, affordable, and spiritually fulfilling travel experiences — especially Hajj and Umrah — with honesty and care at every step.')) ?></textarea>
      </div>
      <div class="settings-field">
        <label>Vision — Title</label>
        <input type="text" name="about_vision_title" value="<?= e(setting('about_vision_title', 'Our Vision')) ?>">
        <label style="margin-top:8px">Vision — Text</label>
        <textarea name="about_vision_text" rows="3" style="width:100%"><?= e(setting('about_vision_text', 'To become the most trusted travel agency in Afghanistan and the region, known for reliability, compassion, and excellence in service.')) ?></textarea>
        <label style="margin-top:8px">Vision — List Items <small>(comma-separated)</small></label>
        <input type="text" name="about_vision_items" value="<?= e(setting('about_vision_items', 'Reliability,Compassion,Excellence')) ?>">
      </div>
      <div class="settings-field">
        <label>Values — Title</label>
        <input type="text" name="about_values_title" value="<?= e(setting('about_values_title', 'Our Values')) ?>">
        <label style="margin-top:8px">Values — Text</label>
        <textarea name="about_values_text" rows="3" style="width:100%"><?= e(setting('about_values_text', "Integrity, compassion, and dedication — we treat every client's journey as if it were our own family's pilgrimage.")) ?></textarea>
      </div>
    </div>
  </div>

  <!-- Timeline -->
  <div class="settings-group">
    <h2 class="settings-group-title">Journey / Timeline</h2>
    <div class="settings-grid">
      <div class="settings-field" style="max-width:100%">
        <label>Section Tag</label>
        <input type="text" name="about_timeline_tag" value="<?= e(setting('about_timeline_tag', 'Our Journey')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Title</label>
        <input type="text" name="about_timeline_title" value="<?= e(setting('about_timeline_title', 'Milestones Along The Way')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Description</label>
        <textarea name="about_timeline_desc" rows="2" style="width:100%"><?= e(setting('about_timeline_desc', 'Two decades of growth, trust, and service to our community.')) ?></textarea>
      </div>
    </div>
    <div style="margin-top:16px;padding:16px;background:var(--bg);border-radius:12px;border:1px dashed var(--border)">
      <p style="font-size:13px;color:var(--muted);margin:0 0 8px">Timeline milestones are managed separately — add, edit, reorder, or delete items.</p>
      <a href="<?= base_url('admin/timeline') ?>" class="btn-new" style="display:inline-flex;gap:6px"><i class="fas fa-timeline"></i> Manage Timeline</a>
    </div>
  </div>

  <!-- Team -->
  <div class="settings-group">
    <h2 class="settings-group-title">Team Section</h2>
    <div class="settings-grid">
      <div class="settings-field" style="max-width:100%">
        <label>Section Tag</label>
        <input type="text" name="about_team_tag" value="<?= e(setting('about_team_tag', 'Meet The Team')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Title</label>
        <input type="text" name="about_team_title" value="<?= e(setting('about_team_title', 'The People Behind Your Journey')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Description</label>
        <textarea name="about_team_desc" rows="2" style="width:100%"><?= e(setting('about_team_desc', 'A dedicated team of travel consultants, visa specialists, and pilgrimage guides.')) ?></textarea>
      </div>
    </div>
    <div style="margin-top:16px;padding:16px;background:var(--bg);border-radius:12px;border:1px dashed var(--border)">
      <p style="font-size:13px;color:var(--muted);margin:0 0 8px">Team members (founder + members) are managed separately with photos, roles, and bios.</p>
      <a href="<?= base_url('admin/team-members') ?>" class="btn-new" style="display:inline-flex;gap:6px"><i class="fas fa-users"></i> Manage Team Members</a>
    </div>
  </div>

  <!-- CTA -->
  <div class="settings-group">
    <h2 class="settings-group-title">CTA Band</h2>
    <div class="settings-grid">
      <div class="settings-field" style="max-width:100%">
        <label>Title</label>
        <input type="text" name="about_cta_title" value="<?= e(setting('about_cta_title', 'Ready To Begin Your Journey?')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Text</label>
        <textarea name="about_cta_text" rows="2" style="width:100%"><?= e(setting('about_cta_text', 'Let our team guide you through every step — from visa to worship at the Haram.')) ?></textarea>
      </div>
      <div class="settings-field">
        <label>Button Text</label>
        <input type="text" name="about_cta_btn_text" value="<?= e(setting('about_cta_btn_text', 'Contact Us Today')) ?>">
      </div>
      <div class="settings-field">
        <label>Button URL</label>
        <input type="text" name="about_cta_btn_url" value="<?= e(setting('about_cta_btn_url', base_url('contact'))) ?>" placeholder="/contact">
      </div>
    </div>
  </div>

  <!-- SEO -->
  <div class="settings-group">
    <h2 class="settings-group-title">SEO</h2>
    <div class="settings-grid">
      <div class="settings-field" style="max-width:100%">
        <label>Meta Title</label>
        <input type="text" name="about_meta_title" value="<?= e(setting('about_meta_title', 'About Us — Al Moqadas Travel Agency')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Meta Description</label>
        <textarea name="about_meta_description" rows="2" style="width:100%"><?= e(setting('about_meta_description', 'Learn about our story since 2010, our mission, vision, values, and the team behind Al Moqadas.')) ?></textarea>
      </div>
    </div>
  </div>

  <div style="margin-top:24px">
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> Save All Changes</button>
  </div>
</form>