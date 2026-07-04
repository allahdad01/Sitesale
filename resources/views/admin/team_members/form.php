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
    <div class="settings-field" style="margin-bottom:12px">
      <label>Name</label>
      <input type="text" name="name" value="<?= e($m['name'] ?? '') ?>" required style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
    </div>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field">
        <label>Role</label>
        <input type="text" name="role" value="<?= e($m['role'] ?? '') ?>" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
      </div>
      <div class="settings-field">
        <label>Type</label>
        <select name="type" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
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
      <input type="file" name="image" accept="image/png,image/jpeg,image/webp" style="font-size:13px">
      <?php if ($img): ?>
        <p style="font-size:12px;color:var(--muted);margin-top:4px">Leave empty to keep current photo.</p>
      <?php endif; ?>
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Bio <small>(for founder/lead)</small></label>
      <textarea name="bio" rows="4" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px;resize:vertical"><?= e($m['bio'] ?? '') ?></textarea>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-save"></i> Update Member</button>
  </div>
</form>