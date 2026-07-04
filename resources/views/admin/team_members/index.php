<div class="topbar">
  <div>
    <h1>Team Members</h1>
    <div class="topbar-date">Manage team members displayed on the About page</div>
  </div>
</div>

<div class="settings-group">
  <h2 class="settings-group-title">All Team Members</h2>

  <?php if (empty($teamMembers)): ?>
    <div class="panel-empty">No team members yet. Add one below.</div>
  <?php else: ?>
    <div class="section-list" style="margin-bottom:16px">
      <?php foreach ($teamMembers as $m): ?>
      <div class="section-item">
        <div class="section-item-avatar" style="width:50px;height:50px;border-radius:50%;background:var(--navy);color:var(--white);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:16px;flex-shrink:0;overflow:hidden">
          <?php if (!empty($m['image'])): ?>
            <img src="<?= asset('storage/uploads/team_members/' . e($m['image'])) ?>" alt="" style="width:100%;height:100%;object-fit:cover">
          <?php else:
            $parts = explode(' ', $m['name']);
            $init = '';
            foreach ($parts as $p) { if ($p !== '') $init .= strtoupper(mb_substr($p, 0, 1)); }
            echo e($init ?: '?');
          endif; ?>
        </div>
        <div class="section-item-body">
          <div class="section-item-top">
            <strong><?= e($m['name'] ?: '(no name)') ?></strong>
            <span class="badge <?= $m['type'] === 'lead' ? 'badge-success' : 'badge-muted' ?>"><?= e($m['type']) ?></span>
            <?php if (!$m['active']): ?><span class="badge badge-danger">Inactive</span><?php endif; ?>
          </div>
          <div class="section-item-desc">
            <?= e($m['role']) ?>
            <?php if ($m['bio']): ?> &middot; <?= e(mb_substr($m['bio'], 0, 60)) ?>&hellip;<?php endif; ?>
          </div>
        </div>
        <div class="section-item-actions">
          <a href="<?= base_url('admin/team-members/edit/' . (int) $m['id']) ?>" class="btn-sm btn-outline">Edit</a>
          <?php if ($m['active']): ?>
            <a href="<?= base_url('admin/team-members/toggle/' . (int) $m['id']) ?>" class="btn-sm btn-muted">Deactivate</a>
          <?php else: ?>
            <a href="<?= base_url('admin/team-members/toggle/' . (int) $m['id']) ?>" class="btn-sm btn-new">Activate</a>
          <?php endif; ?>
          <a href="<?= base_url('admin/team-members/delete/' . (int) $m['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this team member?')">Delete</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>

  <h3 style="font-size:14px;color:var(--navy);margin-bottom:12px">Add New Team Member</h3>
  <form method="post" action="<?= base_url('admin/team-members/add') ?>" enctype="multipart/form-data" style="max-width:600px">
    <?= csrf_field() ?>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Name</label>
      <input type="text" name="name" placeholder="e.g. Mohammad Aref" required style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
    </div>
    <div class="settings-grid" style="margin-bottom:12px">
      <div class="settings-field">
        <label>Role</label>
        <input type="text" name="role" placeholder="e.g. Founder &amp; CEO" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
      </div>
      <div class="settings-field">
        <label>Type</label>
        <select name="type" style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px">
          <option value="member">Team Member</option>
          <option value="lead">Founder / Lead</option>
        </select>
      </div>
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Photo (optional)</label>
      <input type="file" name="image" accept="image/png,image/jpeg,image/webp" style="font-size:13px">
    </div>
    <div class="settings-field" style="margin-bottom:12px">
      <label>Bio <small>(for founder/lead only)</small></label>
      <textarea name="bio" rows="3" placeholder="Short biography..." style="width:100%;padding:10px 12px;border:1px solid var(--border);border-radius:8px;font-size:13px;resize:vertical"></textarea>
    </div>
    <button type="submit" class="btn-new"><i class="fas fa-plus"></i> Add Member</button>
  </form>
</div>