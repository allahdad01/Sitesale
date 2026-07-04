<div class="topbar">
  <div>
    <h1>Enquiries</h1>
    <div class="topbar-date">All customer enquiries</div>
  </div>
  <div style="display:flex;gap:8px">
    <a href="<?= base_url('admin/enquiries') ?>" class="btn-new" style="background:var(--navy)">All</a>
    <a href="<?= base_url('admin/enquiries?status=pending') ?>" class="btn-new" style="background:var(--warning-text)">Pending</a>
  </div>
</div>

<div class="enq-list">
  <?php if (empty($enquiries)): ?>
    <div class="stat-card" style="text-align:center;padding:3rem">
      <p style="color:var(--muted)">No enquiries yet.</p>
    </div>
  <?php else: ?>
    <?php foreach ($enquiries as $enq): ?>
      <div class="enq-item">
        <div class="enq-item-meta">
          <div>
            <span class="enq-item-name"><?= e($enq['full_name'] ?? '') ?></span>
            <span class="enq-item-service"><?= e($enq['service'] ?? '—') ?></span>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            <?= statusBadge($enq['status'] ?? 'pending') ?>
            <span style="font-size:12px;color:var(--muted)"><?= date('j M Y, H:i', strtotime($enq['created_at'])) ?></span>
          </div>
        </div>
        <div class="enq-item-detail">
          <strong>Phone:</strong> <?= e($enq['phone'] ?? '') ?><br>
          <?php if (!empty($enq['email'])): ?><strong>Email:</strong> <?= e($enq['email']) ?><br><?php endif; ?>
          <?php if (!empty($enq['message'])): ?><strong>Message:</strong> <?= nl2br(e($enq['message'])) ?><?php endif; ?>
        </div>
        <div class="enq-item-actions">
          <a href="<?= base_url('admin/enquiries/view/' . (int) $enq['id']) ?>" class="btn-sm btn-outline">View</a>
          <?php if ($enq['status'] === 'pending'): ?>
            <a href="<?= base_url('admin/enquiries/read/' . (int) $enq['id']) ?>" class="btn-sm btn-outline">Mark Read</a>
          <?php endif; ?>
          <?php if ($enq['status'] !== 'replied'): ?>
            <a href="<?= base_url('admin/enquiries/replied/' . (int) $enq['id']) ?>" class="btn-sm btn-outline">Mark Replied</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
