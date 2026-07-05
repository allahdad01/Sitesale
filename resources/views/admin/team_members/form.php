<?php $m = $member; ?>
<div class="topbar">
  <div>
    <h1>Edit Team Member</h1>
    <div class="topbar-date">Update team member details</div>
  </div>
  <a href="<?= base_url('admin/team-members') ?>" class="btn-new" style="background:var(--muted)"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form method="post" action="<?= base_url('admin/team-members/update/' . (int) $m['id']) ?>" enctype="multipart/form-data" style="max-width:600px">
  <?= csrf_field() ?>

  <div class="settings-group">
    <h2 class="settings-group-title">Member Details</h2>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Name</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="name_en" value="<?= e($m['name_en'] ?? $m['name'] ?? '') ?>" required></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="name_ps" value="<?= e($m['name_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="name_fa" value="<?= e($m['name_fa'] ?? '') ?>"></div>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Role</h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><input type="text" name="role_en" value="<?= e($m['role_en'] ?? $m['role'] ?? '') ?>"></div>
      <div class="locale-input"><label>پښتو</label><input type="text" name="role_ps" value="<?= e($m['role_ps'] ?? '') ?>"></div>
      <div class="locale-input"><label>دری</label><input type="text" name="role_fa" value="<?= e($m['role_fa'] ?? '') ?>"></div>
    </div>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field">
        <label>Type</label>
        <select name="type">
          <option value="member" <?= ($m['type'] ?? '') === 'member' ? 'selected' : '' ?>>Team Member</option>
          <option value="lead" <?= ($m['type'] ?? '') === 'lead' ? 'selected' : '' ?>>Founder / Lead</option>
        </select>
      </div>
    </div>
    <?php $img = $m['image'] ?? ''; ?>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Photo</label>
      <?php if ($img): ?>
        <div style="margin-bottom:8px">
          <img src="<?= asset('storage/uploads/team_members/' . e($img)) ?>" alt="" style="width:80px;height:80px;object-fit:cover;border-radius:50%;border:2px solid var(--border)">
        </div>
      <?php endif; ?>
      <input type="file" name="image" accept="image/png,image/jpeg,image/webp">
      <?php if ($img): ?>
        <p style="font-size:12px;color:var(--muted);margin-top:4px">Leave empty to keep current photo.</p>
      <?php endif; ?>
    </div>
    <h4 style="font-size:13px;margin:0 0 4px;color:var(--navy)">Bio <small>(for founder/lead)</small></h4>
    <div class="locale-row" style="margin-bottom:12px">
      <div class="locale-input"><label>EN</label><textarea name="bio_en" rows="4"><?= e($m['bio_en'] ?? $m['bio'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>پښتو</label><textarea name="bio_ps" rows="4"><?= e($m['bio_ps'] ?? '') ?></textarea></div>
      <div class="locale-input"><label>دری</label><textarea name="bio_fa" rows="4"><?= e($m['bio_fa'] ?? '') ?></textarea></div>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> Update Member</button>
  </div>
</form>