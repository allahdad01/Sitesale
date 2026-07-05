<div class="topbar">
  <div>
    <h1>Contact Page</h1>
    <div class="topbar-date">Edit the contact page content — hero, sidebar, form, and FAQ sections</div>
  </div>
</div>

<form method="post" action="<?= base_url('admin/contact/update') ?>">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Hero Section</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Badge Text</label>
        <input type="text" name="contact_hero_badge" value="<?= e(setting('contact_hero_badge', "We're Here To Help")) ?>">
      </div>
      <div class="settings-field">
        <label>Title <small>(HTML allowed)</small></label>
        <input type="text" name="contact_hero_title" value="<?= e(setting('contact_hero_title', "Let's Plan Your<br><span class=\"orange\">Next Journey</span>")) ?>">
      </div>
      <div class="settings-field">
        <label>Subtitle</label>
        <textarea name="contact_hero_subtitle" rows="3"><?= e(setting('contact_hero_subtitle', "Whether you need a full Umrah package, a flight ticket, or just some advice — reach out and our team will respond within 24 hours.")) ?></textarea>
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Sidebar — Contact Info</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Badge Text</label>
        <input type="text" name="contact_sidebar_badge" value="<?= e(setting('contact_sidebar_badge', 'Get In Touch')) ?>">
      </div>
      <div class="settings-field">
        <label>Heading</label>
        <input type="text" name="contact_sidebar_heading" value="<?= e(setting('contact_sidebar_heading', "We'd Love to Hear From You")) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Intro Text</label>
        <textarea name="contact_sidebar_text" rows="2"><?= e(setting('contact_sidebar_text', 'Our travel consultants are ready to help plan your perfect journey.')) ?></textarea>
      </div>
      <div class="settings-field">
        <label style="margin-top:8px">Weekday Hours</label>
        <input type="text" name="contact_hours_week" value="<?= e(setting('contact_hours_week', '8:00 AM – 6:00 PM')) ?>">
      </div>
      <div class="settings-field">
        <label>Friday Hours</label>
        <input type="text" name="contact_hours_friday" value="<?= e(setting('contact_hours_friday', 'Closed')) ?>">
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Form Card</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Badge Text</label>
        <input type="text" name="contact_form_badge" value="<?= e(setting('contact_form_badge', 'Send Us a Message')) ?>">
      </div>
      <div class="settings-field">
        <label>Heading</label>
        <input type="text" name="contact_form_heading" value="<?= e(setting('contact_form_heading', 'Request a Package')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Intro Text</label>
        <textarea name="contact_form_text" rows="2"><?= e(setting('contact_form_text', 'Tell us about your travel plans and we\'ll create a custom quote.')) ?></textarea>
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">FAQ Section</h2>
    <div class="settings-grid">
      <div class="settings-field">
        <label>Section Tag</label>
        <input type="text" name="contact_faq_tag" value="<?= e(setting('contact_faq_tag', 'Common Questions')) ?>">
      </div>
      <div class="settings-field">
        <label>Section Title</label>
        <input type="text" name="contact_faq_title" value="<?= e(setting('contact_faq_title', 'Frequently Asked Questions')) ?>">
      </div>
      <div class="settings-field" style="max-width:100%">
        <label>Section Description</label>
        <textarea name="contact_faq_desc" rows="2"><?= e(setting('contact_faq_desc', 'Quick answers to the most common inquiries we receive.')) ?></textarea>
      </div>
    </div>
  </div>

  <button type="submit" class="btn-new"><i class="fas fa-save"></i> Save All Changes</button>
</form>
