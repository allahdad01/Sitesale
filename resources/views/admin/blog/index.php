<div class="topbar">
  <div><h1>Blog Posts</h1></div>
  <a href="<?= base_url('admin/blog/add') ?>" class="btn-new"><i class="fas fa-plus"></i> New Post</a>
</div>

<div class="table-panel">
  <table>
    <thead><tr><th>Image</th><th>Title</th><th>Author</th><th>Category</th><th>Featured</th><th>Published</th><th>Active</th><th></th></tr></thead>
    <tbody>
      <?php foreach ($posts as $p): ?>
      <tr>
        <td>
          <?php if ($p['image']): ?>
            <img src="<?= asset('storage/uploads/' . e($p['image'])) ?>" alt="" style="width:50px;height:50px;object-fit:cover;border-radius:6px;border:1px solid var(--border)">
          <?php else: ?>
            <span style="color:var(--muted);font-size:11px">—</span>
          <?php endif; ?>
        </td>
        <td><strong><?= e($p['title']) ?></strong></td>
        <td><?= e($p['author'] ?? '—') ?></td>
        <td><?= e($p['category'] ?? '—') ?></td>
        <td><?= $p['featured'] ? '⭐' : '—' ?></td>
        <td><?= $p['published_at'] ? date('j M Y', strtotime($p['published_at'])) : '—' ?></td>
        <td><?= $p['active'] ? 'Yes' : 'No' ?></td>
        <td>
          <a href="<?= base_url('admin/blog/featured/' . (int) $p['id']) ?>" class="btn-sm btn-outline"><?= $p['featured'] ? 'Unfeature' : 'Feature' ?></a>
          <a href="<?= base_url('admin/blog/edit/' . (int) $p['id']) ?>" class="btn-sm btn-outline">Edit</a>
          <a href="<?= base_url('admin/blog/delete/' . (int) $p['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
