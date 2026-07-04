<div class="topbar">
  <div>
    <h1>Enquiry #<?= (int) $enquiry['id'] ?></h1>
    <div class="topbar-date">Received <?= date('j M Y, H:i', strtotime($enquiry['created_at'])) ?></div>
  </div>
  <div style="display:flex;gap:8px">
    <a href="<?= base_url('admin/enquiries') ?>" class="btn-new" style="background:var(--navy)">&larr; Back</a>
  </div>
</div>

<div class="enq-list">
  <div class="enq-item">
    <div class="enq-item-meta">
      <div>
        <span class="enq-item-name"><?= e($enquiry['full_name'] ?? '') ?></span>
        <span class="enq-item-service"><?= e($enquiry['service'] ?? '—') ?></span>
      </div>
      <div style="display:flex;align-items:center;gap:8px">
        <?= statusBadge($enquiry['status'] ?? 'pending') ?>
      </div>
    </div>
    <div class="enq-item-detail" style="line-height:1.8">
      <p><strong>Full Name:</strong> <?= e($enquiry['full_name'] ?? '') ?></p>
      <p><strong>Phone:</strong> <?= e($enquiry['phone'] ?? '') ?></p>
      <?php if (!empty($enquiry['email'])): ?>
        <p><strong>Email:</strong> <?= e($enquiry['email']) ?></p>
      <?php endif; ?>
      <p><strong>Service:</strong> <?= e($enquiry['service'] ?? '—') ?></p>
      <p><strong>Date:</strong> <?= date('j M Y, H:i', strtotime($enquiry['created_at'])) ?></p>
      <?php if (!empty($enquiry['ip_address'])): ?>
        <p><strong>IP Address:</strong> <?= e($enquiry['ip_address']) ?></p>
      <?php endif; ?>
      <?php if (!empty($enquiry['message'])): ?>
        <hr style="margin:16px 0;border:0;border-top:1px solid var(--border,#eee)">
        <p><strong>Message:</strong></p>
        <div style="background:#f9f9f9;padding:16px;border-radius:8px;margin-top:8px;white-space:pre-wrap"><?= e($enquiry['message']) ?></div>
      <?php endif; ?>
    </div>
    <div class="enq-item-actions" style="margin-top:16px">
      <?php if ($enquiry['status'] === 'pending'): ?>
        <a href="<?= base_url('admin/enquiries/read/' . (int) $enquiry['id']) ?>" class="btn-primary btn-sm">Mark as Read</a>
      <?php endif; ?>
      <?php if ($enquiry['status'] !== 'replied'): ?>
        <a href="<?= base_url('admin/enquiries/replied/' . (int) $enquiry['id']) ?>" class="btn-primary btn-sm">Mark as Replied</a>
      <?php endif; ?>
    </div>
  </div>
</div>
