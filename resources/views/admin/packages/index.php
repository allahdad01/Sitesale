<div class="topbar">
  <div>
    <h1>Packages</h1>
  </div>
  <a href="<?= base_url('admin/packages/add') ?>" class="btn-new"><i class="fas fa-plus"></i> Add Package</a>
</div>

<div class="table-panel">
  <table>
    <thead>
      <tr><th>Title</th><th>Category</th><th>Destination</th><th>Price</th><th>Duration</th><th>Featured</th><th>Active</th><th></th></tr>
    </thead>
    <tbody>
      <?php foreach ($packages as $p): ?>
      <tr>
        <td><strong><?= e($p['title']) ?></strong></td>
        <td><?= e($p['category']) ?></td>
        <td><?= e($p['destination'] ?? '—') ?></td>
        <td>$<?= number_format($p['price']) ?></td>
        <td><?= (int) $p['duration_days'] ?> days</td>
        <td><?= $p['featured'] ? '⭐' : '—' ?></td>
        <td><?= $p['active'] ? 'Yes' : 'No' ?></td>
        <td>
          <a href="<?= base_url('admin/packages/featured/' . (int) $p['id']) ?>" class="btn-sm btn-outline"><?= $p['featured'] ? 'Unfeature' : 'Feature' ?></a>
          <a href="<?= base_url('admin/packages/toggle/' . (int) $p['id']) ?>" class="btn-sm btn-outline"><?= $p['active'] ? 'Disable' : 'Enable' ?></a>
          <a href="<?= base_url('admin/packages/edit/' . (int) $p['id']) ?>" class="btn-sm btn-outline">Edit</a>
          <a href="<?= base_url('admin/packages/delete/' . (int) $p['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
