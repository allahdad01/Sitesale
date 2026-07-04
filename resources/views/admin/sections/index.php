<div class="topbar">
  <div>
    <h1>Home Page Sections</h1>
    <div class="topbar-date">Manage sections — toggle, reorder, add custom content</div>
  </div>
  <a href="<?= base_url('admin/sections/add') ?>" class="btn-new"><i class="fas fa-plus"></i> Add Section</a>
</div>

<form method="post" action="<?= base_url('admin/sections/reorder') ?>" id="reorderForm">
  <?= csrf_field() ?>
  <div class="section-list" id="sectionList">
    <?php foreach ($sections as $i => $sec): ?>
      <div class="section-item" data-id="<?= (int) $sec['id'] ?>">
        <div class="section-item-handle"><i class="fas fa-grip-lines"></i></div>
        <div class="section-item-body">
          <div class="section-item-top">
            <div>
              <strong><?= e($sec['label'] ?: $sec['section_key']) ?></strong>
              <span class="section-item-meta">
                <?= e($sec['type']) ?>
                <?php if ($sec['type'] === 'builtin'): ?>
                  <span class="badge badge-neutral">built-in</span>
                <?php endif; ?>
              </span>
            </div>
            <div class="section-item-actions">
              <span class="section-status <?= $sec['active'] ? 'active' : '' ?>">
                <?= $sec['active'] ? 'Active' : 'Inactive' ?>
              </span>
              <a href="<?= base_url('admin/sections/toggle/' . (int) $sec['id']) ?>" class="btn-sm btn-outline">
                <?= $sec['active'] ? 'Deactivate' : 'Activate' ?>
              </a>
              <a href="<?= base_url('admin/sections/edit/' . (int) $sec['id']) ?>" class="btn-sm btn-outline">Edit</a>
              <?php if ($sec['type'] !== 'builtin'): ?>
                <a href="<?= base_url('admin/sections/delete/' . (int) $sec['id']) ?>" class="btn-sm btn-danger" onclick="return confirm('Delete this section?')">Delete</a>
              <?php endif; ?>
              <input type="hidden" name="order[<?= (int) $sec['id'] ?>]" value="<?= (int) $sec['sort_order'] ?>" class="order-input">
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
  <button type="submit" class="btn-new" style="margin-top:16px"><i class="fas fa-save"></i> Save Order</button>
</form>

<script>
(function() {
  var list = document.getElementById('sectionList');
  var items = list.querySelectorAll('.section-item');
  var dragSrc = null;

  items.forEach(function(item) {
    item.querySelector('.section-item-handle').addEventListener('mousedown', function(e) {
      e.preventDefault();
      dragSrc = item;
      item.classList.add('dragging');
      document.addEventListener('mousemove', onDrag);
      document.addEventListener('mouseup', onDrop);
    });
  });

  function onDrag(e) {
    if (!dragSrc) return;
    var closest = null;
    var closestOffset = Number.MAX_VALUE;
    var rect = dragSrc.getBoundingClientRect();
    var midY = rect.top + rect.height / 2;

    items.forEach(function(item) {
      if (item === dragSrc) return;
      var r = item.getBoundingClientRect();
      var offset = Math.abs(e.clientY - (r.top + r.height / 2));
      if (offset < closestOffset) {
        closestOffset = offset;
        closest = item;
      }
    });

    if (closest) {
      var closestRect = closest.getBoundingClientRect();
      if (e.clientY < closestRect.top + closestRect.height / 2) {
        closest.parentNode.insertBefore(dragSrc, closest);
      } else {
        closest.parentNode.insertBefore(dragSrc, closest.nextSibling);
      }
      // re-index inputs
      updateOrderInputs();
    }
  }

  function onDrop() {
    if (dragSrc) dragSrc.classList.remove('dragging');
    dragSrc = null;
    document.removeEventListener('mousemove', onDrag);
    document.removeEventListener('mouseup', onDrop);
  }

  function updateOrderInputs() {
    var inputs = list.querySelectorAll('.order-input');
    inputs.forEach(function(inp, idx) { inp.value = idx; });
  }
})();
</script>
