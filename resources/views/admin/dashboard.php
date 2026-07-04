<div class="topbar">
  <div>
    <h1>Overview</h1>
    <div class="topbar-date"><?= e($todayLabel) ?></div>
  </div>
  <a href="<?= base_url('admin/enquiries') ?>" class="btn-new"><i class="fas fa-message"></i> View Enquiries</a>
</div>

<div class="stats-grid" style="margin-bottom:24px">
  <div class="stat-card">
    <div class="stat-label">Bookings this month</div>
    <div class="stat-value"><?= number_format($thisMonthBookings) ?></div>
    <div class="stat-delta neutral">New bookings this month</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Pending Bookings</div>
    <div class="stat-value"><?= number_format($pendingBookings) ?></div>
    <div class="stat-delta warn"><i class="fas fa-clock"></i> Awaiting confirmation</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Confirmed</div>
    <div class="stat-value"><?= number_format($confirmedBookings) ?></div>
    <div class="stat-delta success"><i class="fas fa-check"></i> Active bookings</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Total enquiries</div>
    <div class="stat-value"><?= number_format($totalEnquiries) ?></div>
    <div class="stat-delta neutral">All time</div>
  </div>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <div class="stat-label">Enquiries this month</div>
    <div class="stat-value"><?= number_format($thisMonthEnq) ?></div>
    <div class="stat-delta neutral">New submissions this month</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Pending enquiries</div>
    <div class="stat-value"><?= number_format($pendingEnquiries) ?></div>
    <div class="stat-delta warn"><i class="fas fa-clock"></i> Awaiting response</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Active packages</div>
    <div class="stat-value">6</div>
    <div class="stat-delta neutral">2 Hajj, 4 Umrah</div>
  </div>
  <div class="stat-card">
    <div class="stat-label">Total bookings</div>
    <div class="stat-value"><?= number_format($totalBookings) ?></div>
    <div class="stat-delta neutral">All time</div>
  </div>
</div>

<div class="panels-grid">
  <div class="panel">
    <div class="panel-title">Bookings by month, last 6 months</div>
    <div class="bar-chart">
      <?php if (!empty($monthlyBookings)): ?>
        <?php $maxB = max(array_column($monthlyBookings, 'value')); ?>
        <?php foreach ($monthlyBookings as $row): ?>
          <?php $heightPct = $maxB > 0 ? max(round(($row['value'] / $maxB) * 100), 5) : 5; ?>
          <div class="bar-col">
            <div class="bar" style="height: <?= $heightPct ?>%;background:var(--primary)"></div>
            <div class="bar-col-label"><?= e($row['label']) ?></div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p class="panel-empty">No data yet.</p>
      <?php endif; ?>
    </div>
  </div>

  <div class="panel">
    <div class="panel-title">Booking Status</div>
    <div style="display:flex;flex-direction:column;gap:16px;margin-top:4px">
      <div style="display:flex;justify-content:space-between;font-size:13px">
        <span style="color:var(--muted)">Pending</span>
        <span style="font-weight:600"><?= $pendingBookings ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:13px">
        <span style="color:var(--muted)">Confirmed</span>
        <span style="font-weight:600"><?= $confirmedBookings ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:13px">
        <span style="color:var(--muted)">Completed</span>
        <span style="font-weight:600"><?= $completedBookings ?></span>
      </div>
      <div style="display:flex;justify-content:space-between;font-size:13px">
        <span style="color:var(--muted)">Cancelled</span>
        <span style="font-weight:600"><?= $cancelledBookings ?></span>
      </div>
    </div>
  </div>
</div>

<div class="table-panel">
  <div class="table-panel-head">
    <div class="panel-title" style="margin:0">Recent bookings</div>
    <a href="<?= base_url('admin/bookings') ?>">View all</a>
  </div>
  <table>
    <thead>
      <tr>
        <th>Ref</th>
        <th>Name</th>
        <th>Package</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($recentBookings)): ?>
        <?php foreach ($recentBookings as $b): ?>
          <tr>
            <td style="font-family:monospace;font-size:12px"><?= e($b['booking_ref']) ?></td>
            <td><?= e($b['full_name']) ?></td>
            <td style="color:var(--muted)"><?= e($b['package_title'] ?? $b['service'] ?? '—') ?></td>
            <td style="color:var(--muted)"><?= date('j M', strtotime($b['created_at'])) ?></td>
            <td>
              <?php
                $m = ['pending'=>'badge-warning','confirmed'=>'badge-success','completed'=>'badge-neutral','cancelled'=>'badge'];
                $c = $m[$b['status']] ?? 'badge-neutral';
              ?>
              <span class="<?= $c ?>"><?= ucfirst($b['status']) ?></span>
            </td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No bookings yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div class="table-panel">
  <div class="table-panel-head">
    <div class="panel-title" style="margin:0">Recent enquiries</div>
    <a href="<?= base_url('admin/enquiries') ?>">View all</a>
  </div>
  <table>
    <thead>
      <tr>
        <th>Name</th>
        <th>Phone</th>
        <th>Service</th>
        <th>Date</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($recentEnquiries)): ?>
        <?php foreach ($recentEnquiries as $enq): ?>
          <tr>
            <td><?= e($enq['full_name']) ?></td>
            <td style="color:var(--muted)"><?= e($enq['phone']) ?></td>
            <td style="color:var(--muted)"><?= e($enq['service'] ?? '—') ?></td>
            <td style="color:var(--muted)"><?= date('j M', strtotime($enq['created_at'])) ?></td>
            <td><?= statusBadge($enq['status']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr><td colspan="5" style="text-align:center;color:var(--muted);padding:2rem">No enquiries yet.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
