<div class="topbar">
  <div>
    <h1>Bookings</h1>
    <div class="topbar-date">All customer bookings</div>
  </div>
  <div style="display:flex;gap:8px">
    <a href="<?= base_url('admin/bookings') ?>" class="btn-new" style="background:var(--navy)">All</a>
    <a href="<?= base_url('admin/bookings?status=pending') ?>" class="btn-new" style="background:var(--warning-text)">Pending</a>
    <a href="<?= base_url('admin/bookings?status=confirmed') ?>" class="btn-new" style="background:var(--primary)">Confirmed</a>
    <a href="<?= base_url('admin/bookings?status=completed') ?>" class="btn-new" style="background:var(--success-text)">Completed</a>
    <a href="<?= base_url('admin/bookings?status=cancelled') ?>" class="btn-new" style="background:#e74c3c">Cancelled</a>
  </div>
</div>

<div class="enq-list">
  <?php if (empty($bookings)): ?>
    <div class="stat-card" style="text-align:center;padding:3rem">
      <p style="color:var(--muted)">No bookings yet.</p>
    </div>
  <?php else: ?>
    <?php foreach ($bookings as $b): ?>
      <div class="enq-item">
        <div class="enq-item-meta">
          <div>
            <span class="enq-item-name" style="font-family:monospace;font-size:13px;color:var(--primary)"><?= e($b['booking_ref']) ?></span>
            <span class="enq-item-service"><?= e($b['full_name']) ?> — <?= e($b['package_title'] ?? $b['service'] ?? '—') ?></span>
          </div>
          <div style="display:flex;align-items:center;gap:8px">
            <?php
              $statusMap = [
                'pending'   => ['label' => 'Pending',   'class' => 'badge-warning'],
                'confirmed' => ['label' => 'Confirmed', 'class' => 'badge-success'],
                'completed' => ['label' => 'Completed', 'class' => 'badge-neutral'],
                'cancelled' => ['label' => 'Cancelled', 'class' => 'badge' /* red-ish */],
              ];
              $s = $statusMap[$b['status']] ?? ['label' => ucfirst($b['status']), 'class' => 'badge-neutral'];
            ?>
            <span class="<?= e($s['class']) ?>"><?= e($s['label']) ?></span>
            <span style="font-size:12px;color:var(--muted)"><?= date('j M Y', strtotime($b['created_at'])) ?></span>
          </div>
        </div>
        <div class="enq-item-detail">
          <strong>Travel Date:</strong> <?= e($b['travel_date'] ?? '—') ?> &middot;
          <strong>Group:</strong> <?= (int) $b['group_size'] ?> &middot;
          <strong>Phone:</strong> <?= e($b['phone'] ?? '') ?>
        </div>
        <div class="enq-item-actions">
          <a href="<?= base_url('admin/bookings/view/' . (int) $b['id']) ?>" class="btn-sm btn-outline">View</a>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
