<div class="topbar">
  <div>
    <h1>Booking <?= e($booking['booking_ref']) ?></h1>
    <div class="topbar-date">Created <?= date('j M Y, H:i', strtotime($booking['created_at'])) ?></div>
  </div>
  <div style="display:flex;gap:8px">
    <a href="<?= base_url('admin/bookings') ?>" class="btn-new" style="background:var(--navy)">&larr; Back</a>
  </div>
</div>

<div class="enq-list">
  <div class="enq-item">
    <div class="enq-item-meta">
      <div>
        <span class="enq-item-name"><?= e($booking['full_name']) ?></span>
        <span class="enq-item-service"><?= e($booking['package_title'] ?? $booking['service'] ?? '—') ?></span>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        <?php
          $statusMap = [
            'pending'   => ['label' => 'Pending',   'class' => 'badge-warning'],
            'confirmed' => ['label' => 'Confirmed', 'class' => 'badge-success'],
            'completed' => ['label' => 'Completed', 'class' => 'badge-neutral'],
            'cancelled' => ['label' => 'Cancelled', 'class' => 'badge'],
          ];
          $s = $statusMap[$booking['status']] ?? ['label' => ucfirst($booking['status']), 'class' => 'badge-neutral'];
        ?>
        <span class="<?= e($s['class']) ?>"><?= e($s['label']) ?></span>
      </div>
    </div>

    <div class="enq-item-detail" style="line-height:1.8">
      <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px 24px">
        <p><strong>Booking Ref:</strong> <span style="font-family:monospace"><?= e($booking['booking_ref']) ?></span></p>
        <p><strong>Status:</strong> <?= e($s['label']) ?></p>
        <p><strong>Full Name:</strong> <?= e($booking['full_name']) ?></p>
        <p><strong>Phone:</strong> <?= e($booking['phone']) ?></p>
        <p><strong>Email:</strong> <?= e($booking['email'] ?? '—') ?></p>
        <p><strong>Package:</strong> <?= e($booking['package_title'] ?? '—') ?></p>
        <p><strong>Travel Date:</strong> <?= e($booking['travel_date'] ?? '—') ?></p>
        <p><strong>Group Size:</strong> <?= (int) $booking['group_size'] ?></p>
        <p><strong>Service:</strong> <?= e($booking['service'] ?? '—') ?></p>
        <p><strong>IP Address:</strong> <?= e($booking['ip_address'] ?? '—') ?></p>
        <p><strong>Created:</strong> <?= date('j M Y, H:i', strtotime($booking['created_at'])) ?></p>
        <p><strong>Updated:</strong> <?= date('j M Y, H:i', strtotime($booking['updated_at'])) ?></p>
      </div>

      <?php if (!empty($booking['message'])): ?>
        <hr style="margin:16px 0;border:0;border-top:1px solid var(--border,#eee)">
        <p><strong>Special Requests:</strong></p>
        <div style="background:#f9f9f9;padding:16px;border-radius:8px;margin-top:8px;white-space:pre-wrap"><?= e($booking['message']) ?></div>
      <?php endif; ?>
    </div>

    <div class="enq-item-actions" style="margin-top:16px;display:flex;gap:8px;flex-wrap:wrap">
      <?php if ($booking['status'] === 'pending'): ?>
        <a href="<?= base_url('admin/bookings/confirm/' . (int) $booking['id']) ?>" class="btn-primary btn-sm" onclick="return confirm('Confirm this booking?')">Confirm Booking</a>
        <a href="<?= base_url('admin/bookings/cancel/' . (int) $booking['id']) ?>" class="btn-sm" style="background:#e74c3c;color:#fff" onclick="return confirm('Cancel this booking?')">Cancel Booking</a>
      <?php endif; ?>
      <?php if ($booking['status'] === 'confirmed'): ?>
        <a href="<?= base_url('admin/bookings/complete/' . (int) $booking['id']) ?>" class="btn-primary btn-sm" onclick="return confirm('Mark as completed?')">Mark Completed</a>
        <a href="<?= base_url('admin/bookings/cancel/' . (int) $booking['id']) ?>" class="btn-sm" style="background:#e74c3c;color:#fff" onclick="return confirm('Cancel this booking?')">Cancel Booking</a>
      <?php endif; ?>
      <?php if ($booking['status'] === 'completed' || $booking['status'] === 'cancelled'): ?>
        <span style="font-size:13px;opacity:0.6">No further actions available</span>
      <?php endif; ?>
    </div>
  </div>

  <div class="enq-item" style="margin-top:16px">
    <form method="POST" action="<?= base_url('admin/bookings/notes/' . (int) $booking['id']) ?>">
      <h3 style="margin:0 0 12px;font-size:15px">Admin Notes</h3>
      <textarea name="admin_notes" rows="4" style="width:100%;padding:12px;border:1px solid var(--border,#eee);border-radius:8px;font-family:inherit;font-size:14px;resize:vertical"><?= e($booking['admin_notes'] ?? '') ?></textarea>
      <button type="submit" class="btn-primary btn-sm" style="margin-top:8px">Save Notes</button>
    </form>
  </div>
</div>
