<?php
$introText = setting('about_intro_text', "Al Moqadas Travel Agency was founded in Kabul with a single purpose: to make the sacred journeys of Hajj and Umrah accessible, comfortable, and worry-free for every Afghan family.\n\nWhat began as a small office helping neighbors book their first pilgrimage has grown into a full-service travel house &mdash; handling flights, visas, hotels, and tours across more than 30 destinations worldwide.\n\nThrough every chapter, our promise has stayed the same: treat every traveler like family, and handle every detail like it's our own pilgrimage.");
$introParagraphs = explode("\n\n", $introText);

$visionItems = explode(',', setting('about_vision_items', 'Reliability,Compassion,Excellence'));
$introImg = setting('about_intro_image', '');
$introImgUrl = $introImg ? (str_starts_with($introImg, 'http') ? $introImg : asset('storage/uploads/' . $introImg)) : 'https://commons.wikimedia.org/wiki/Special:FilePath/Kaaba_Mecca.jpg?width=700';
$ctaBtnUrl = setting('about_cta_btn_url', base_url('contact'));
?>

<?php if (in_array('hero', $activeSections ?? [])): ?>
<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-star"></i> <?= e(setting('about_hero_badge', 'Our Story Since 2010')) ?></div>

  <h1><?= setting('about_hero_title', 'Guiding Hearts To<br><span class="orange">Sacred Places</span>') ?></h1>

  <p class="hero-sub"><?= e(setting('about_hero_subtitle', 'For over two decades, Al Moqadas has walked beside thousands of pilgrims and travelers — turning every journey into an experience of faith, comfort, and trust.')) ?></p>

  <div class="breadcrumb">
    <span><?= e(setting('about_breadcrumb_home', 'Home')) ?></span> <span>/</span> <span class="current"><?= e(setting('about_breadcrumb_current', 'About Us')) ?></span>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('intro', $activeSections ?? [])): ?>
<section class="about-intro">
  <div class="about-intro-grid">
    <div class="about-intro-image">
      <div class="about-intro-badge"><?= e(setting('about_intro_badge', '20+ Years of Trust')) ?></div>
      <img src="<?= e($introImgUrl) ?>" alt="About Al Moqadas">
    </div>
    <div class="about-intro-content">
      <span class="section-tag"><?= e(setting('about_intro_tag', 'Who We Are')) ?></span>
      <h2 class="section-title"><?= e(setting('about_intro_title', 'A Journey Built On Faith & Service')) ?></h2>
      <?php foreach ($introParagraphs as $para): ?>
      <p><?= $para ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('stats', $activeSections ?? [])): ?>
<section class="about-stats">
  <div class="about-stats-grid">
    <?php for ($i = 1; $i <= 4; $i++): ?>
    <div class="about-stat">
      <div class="about-stat-num"><?= e(setting("about_stat{$i}_num", ['20+','50K+','30+','100%'][$i-1])) ?></div>
      <div class="about-stat-label"><?= e(setting("about_stat{$i}_label", ['Years Experience','Happy Pilgrims','Destinations','Visa Success'][$i-1])) ?></div>
    </div>
    <?php endfor; ?>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('values', $activeSections ?? [])): ?>
<section class="about-values">
  <div class="about-values-inner">
    <div class="about-values-header">
      <span class="section-tag"><?= e(setting('about_section_tag', 'What Drives Us')) ?></span>
      <h2 class="section-title"><?= e(setting('about_section_title', 'Mission, Vision & Values')) ?></h2>
      <p class="section-desc"><?= e(setting('about_section_desc', 'The principles that guide every package we plan and every traveler we serve.')) ?></p>
    </div>

    <div class="about-values-cards">
      <div class="about-value-card">
        <div class="about-vc-icon" style="background:var(--primary);box-shadow:0 6px 20px rgba(254,89,11,0.3);">
          <i class="fas fa-bullseye"></i>
        </div>
        <h3><?= e(setting('about_mission_title', 'Our Mission')) ?></h3>
        <p><?= e(setting('about_mission_text', 'To deliver safe, affordable, and spiritually fulfilling travel experiences — especially Hajj and Umrah — with honesty and care at every step.')) ?></p>
      </div>
      <div class="about-value-card">
        <div class="about-vc-icon" style="background:#0d9488;box-shadow:0 6px 20px rgba(13,148,136,0.3);">
          <i class="fas fa-eye"></i>
        </div>
        <h3><?= e(setting('about_vision_title', 'Our Vision')) ?></h3>
        <p><?= e(setting('about_vision_text', 'To become the most trusted travel agency in Afghanistan and the region, known for reliability, compassion, and excellence in service.')) ?></p>
        <div class="about-vc-list">
          <?php foreach ($visionItems as $item): ?>
          <span><i class="fas fa-circle"></i> <?= e(trim($item)) ?></span>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="about-value-card">
        <div class="about-vc-icon" style="background:#7c3aed;box-shadow:0 6px 20px rgba(124,58,237,0.3);">
          <i class="fas fa-handshake"></i>
        </div>
        <h3><?= e(setting('about_values_title', 'Our Values')) ?></h3>
        <p><?= e(setting('about_values_text', 'Integrity, compassion, and dedication — we treat every client\'s journey as if it were our own family\'s pilgrimage.')) ?></p>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>

<?php if (in_array('timeline', $activeSections ?? [])): ?>
<?php $tItems = $timelineItems ?? []; ?>
<section class="journey">
  <span class="section-tag"><?= e(setting('about_timeline_tag', 'Our Journey')) ?></span>
  <h2 class="section-title"><?= e(setting('about_timeline_title', 'Milestones Along The Way')) ?></h2>
  <p class="section-desc"><?= e(setting('about_timeline_desc', 'Two decades of growth, trust, and service to our community.')) ?></p>

  <?php if (!empty($tItems)): ?>
  <div class="timeline">
    <?php foreach ($tItems as $idx => $t):
      $side = $idx % 2 === 0 ? 'left' : 'right';
    ?>
    <div class="timeline-item">
      <?php if ($side === 'left'): ?>
      <div class="timeline-content">
        <div class="timeline-year"><?= e($t['year'] ?? '') ?></div>
        <h4><?= e($t['title'] ?? '') ?></h4>
        <p><?= e($t['text'] ?? '') ?></p>
      </div>
      <div class="timeline-dot"></div>
      <div class="timeline-spacer"></div>
      <?php else: ?>
      <div class="timeline-spacer"></div>
      <div class="timeline-dot"></div>
      <div class="timeline-content">
        <div class="timeline-year"><?= e($t['year'] ?? '') ?></div>
        <h4><?= e($t['title'] ?? '') ?></h4>
        <p><?= e($t['text'] ?? '') ?></p>
      </div>
      <?php endif; ?>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>

<?php if (in_array('team', $activeSections ?? [])): ?>
<?php
$tLead = $teamLead ?? null;
$tMembers = $teamMembers ?? [];
?>
<section class="about-team">
  <div style="text-align:center;margin-bottom:50px;">
    <span class="section-tag"><?= e(setting('about_team_tag', 'Meet The Team')) ?></span>
    <h2 class="section-title"><?= e(setting('about_team_title', 'The People Behind Your Journey')) ?></h2>
    <p class="section-desc" style="margin:0 auto;"><?= e(setting('about_team_desc', 'A dedicated team of travel consultants, visa specialists, and pilgrimage guides.')) ?></p>
  </div>

  <?php if ($tLead):
    $img = $tLead['image'] ?? '';
    $initials = '';
    foreach (explode(' ', $tLead['name'] ?? '') as $p) { if ($p !== '') $initials .= strtoupper(mb_substr($p, 0, 1)); }
  ?>
  <div class="about-team-lead">
    <div class="about-team-lead-avatar" style="<?= $img ? 'background:none;box-shadow:none' : '' ?>">
      <?php if ($img): ?>
        <img src="<?= asset('storage/uploads/team_members/' . e($img)) ?>" alt="<?= e($tLead['name']) ?>" style="width:100%;height:100%;object-fit:cover;border-radius:50%">
      <?php else: ?>
        <span><?= e($initials ?: '?') ?></span>
      <?php endif; ?>
    </div>
    <div class="about-team-lead-info">
      <span class="about-team-lead-label"><?= e($tLead['role'] ?? '') ?></span>
      <h3><?= e($tLead['name'] ?? '') ?></h3>
      <p><?= e($tLead['bio'] ?? '') ?></p>
    </div>
  </div>
  <?php endif; ?>

  <?php if (!empty($tMembers)): ?>
  <div class="about-team-grid">
    <?php foreach ($tMembers as $m):
      $img = $m['image'] ?? '';
      $initials = '';
      foreach (explode(' ', $m['name'] ?? '') as $p) { if ($p !== '') $initials .= strtoupper(mb_substr($p, 0, 1)); }
    ?>
    <div class="about-team-card">
      <div class="about-team-avatar" style="<?= $img ? 'background:none;box-shadow:none;overflow:hidden' : '' ?>">
        <?php if ($img): ?>
          <img src="<?= asset('storage/uploads/team_members/' . e($img)) ?>" alt="<?= e($m['name']) ?>" style="width:100%;height:100%;object-fit:cover">
        <?php else: ?>
          <span><?= e($initials ?: '?') ?></span>
        <?php endif; ?>
      </div>
      <h3><?= e($m['name'] ?? '') ?></h3>
      <span class="about-team-role"><?= e($m['role'] ?? '') ?></span>
    </div>
    <?php endforeach; ?>
  </div>
  <?php endif; ?>
</section>
<?php endif; ?>

<?php if (in_array('cta', $activeSections ?? [])): ?>
<section class="cta-band">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <h2><?= e(setting('about_cta_title', 'Ready To Begin Your Journey?')) ?></h2>
  <p><?= e(setting('about_cta_text', 'Let our team guide you through every step — from visa to worship at the Haram.')) ?></p>
  <a href="<?= e($ctaBtnUrl) ?>" class="btn-primary"><?= e(setting('about_cta_btn_text', 'Contact Us Today')) ?> <i class="fas fa-arrow-right"></i></a>
</section>
<?php endif; ?>

<?php foreach ($customSections ?? [] as $section): ?>
<section class="custom-section">
  <?= $section['content'] ?>
</section>
<?php endforeach; ?>

<style>
.about-intro {
  background: var(--white);
  padding: 100px 24px;
}
.about-intro-grid {
  max-width: 1100px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
}
.about-intro-image {
  position: relative;
}
.about-intro-image img {
  width: 100%;
  border-radius: 20px;
  box-shadow: 0 20px 60px rgba(42,42,104,0.15);
  display: block;
}
.about-intro-badge {
  position: absolute;
  bottom: -18px;
  right: -18px;
  background: var(--primary);
  color: var(--white);
  padding: 18px 24px;
  border-radius: 16px;
  font-weight: 700;
  font-size: 14px;
  box-shadow: 0 8px 24px rgba(254,89,11,0.35);
}
.about-intro-content p {
  color: var(--muted);
  font-size: 15px;
  line-height: 1.8;
  margin-bottom: 16px;
}

.about-stats {
  background: var(--navy);
  padding: 70px 24px;
}
.about-stats-grid {
  max-width: 1000px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 24px;
  text-align: center;
}
.about-stat-num {
  font-family: 'Cinzel', serif;
  font-size: 42px;
  font-weight: 800;
  color: var(--primary);
  line-height: 1;
  margin-bottom: 6px;
}
.about-stat-label {
  font-size: 12px;
  color: rgba(255,255,255,0.55);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  font-weight: 600;
}

.about-values {
  background: var(--bg);
  padding: 100px 24px;
}
.about-values-inner {
  max-width: 1100px;
  margin: 0 auto;
}
.about-values-header {
  text-align: center;
  margin-bottom: 56px;
}
.about-values-header .section-desc { margin: 0 auto; }
.about-values-cards {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
.about-value-card {
  background: var(--white);
  border-radius: 16px;
  padding: 40px 32px;
  transition: transform 0.3s, box-shadow 0.3s;
}
.about-value-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 16px 40px rgba(42,42,104,0.1);
}
.about-vc-icon {
  width: 52px;
  height: 52px;
  border-radius: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 22px;
  margin-bottom: 24px;
  color: var(--white);
}
.about-value-card h3 {
  font-family: 'Cinzel', serif;
  font-size: 19px;
  color: var(--navy);
  margin-bottom: 12px;
}
.about-value-card p {
  color: var(--muted);
  font-size: 14px;
  line-height: 1.8;
}
.about-vc-list {
  display: flex;
  flex-wrap: wrap;
  gap: 12px;
  margin-top: 18px;
  padding-top: 18px;
  border-top: 1px solid rgba(0,0,0,0.06);
}
.about-vc-list span {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 12px;
  font-weight: 600;
  color: var(--navy);
  text-transform: uppercase;
  letter-spacing: 0.5px;
}
.about-vc-list span i {
  font-size: 6px;
  color: var(--primary);
}

.about-team {
  background: var(--white);
  padding: 100px 24px;
}

.about-team-lead {
  max-width: 820px;
  margin: 0 auto 48px;
  display: grid;
  grid-template-columns: auto 1fr;
  gap: 36px;
  align-items: center;
  background: var(--bg);
  border-radius: 20px;
  padding: 40px 44px;
}
.about-team-lead-avatar {
  width: 100px;
  height: 100px;
  background: var(--primary);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  box-shadow: 0 8px 24px rgba(254,89,11,0.3);
}
.about-team-lead-avatar span {
  font-family: 'Cinzel', serif;
  font-size: 32px;
  font-weight: 700;
  color: var(--white);
}
.about-team-lead-label {
  font-size: 11px;
  font-weight: 700;
  color: var(--primary);
  text-transform: uppercase;
  letter-spacing: 1.5px;
  display: block;
  margin-bottom: 6px;
}
.about-team-lead-info h3 {
  font-family: 'Cinzel', serif;
  font-size: 26px;
  color: var(--navy);
  margin-bottom: 10px;
}
.about-team-lead-info p {
  font-size: 14px;
  color: var(--muted);
  line-height: 1.8;
}

.about-team-grid {
  max-width: 1100px;
  margin: 0 auto;
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 24px;
}
.about-team-card {
  background: var(--bg);
  border-radius: 20px;
  padding: 32px 24px;
  text-align: center;
  transition: transform 0.3s, box-shadow 0.3s;
}
.about-team-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(42,42,104,0.1);
}
.about-team-avatar {
  width: 64px;
  height: 64px;
  background: var(--navy);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 16px;
}
.about-team-avatar span {
  font-family: 'Cinzel', serif;
  font-size: 20px;
  font-weight: 700;
  color: var(--white);
}
.about-team-card h3 {
  font-family: 'Cinzel', serif;
  font-size: 16px;
  color: var(--navy);
  margin-bottom: 4px;
}
.about-team-role {
  font-size: 11px;
  font-weight: 700;
  color: var(--primary);
  text-transform: uppercase;
  letter-spacing: 1px;
  display: block;
}

.journey {
  padding: 100px 24px;
}

@media (max-width: 900px) {
  .about-intro-grid { grid-template-columns: 1fr; gap: 40px; }
  .about-intro-badge { right: 0; bottom: -18px; }
  .about-stats-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; }
  .about-values-cards { grid-template-columns: 1fr; max-width: 480px; margin: 0 auto; }
  .about-team-lead { grid-template-columns: 1fr; text-align: center; padding: 32px 24px; gap: 20px; }
  .about-team-lead-avatar { margin: 0 auto; }
  .about-team-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 480px) {
  .about-team-grid { grid-template-columns: 1fr; }
  .about-stat-num { font-size: 32px; }
}
</style>