<?php $post = $post ?? null; ?>
<script src="<?= asset('assets/tinymce/tinymce.min.js') ?>"></script>
<script>
function previewImage(input, previewId) {
  var preview = document.getElementById(previewId);
  if (!preview) return;
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function (e) {
      preview.innerHTML = '<img src="' + e.target.result + '" alt="">';
      preview.className = 'image-preview';
    };
    reader.readAsDataURL(input.files[0]);
  }
}

tinymce.init({
  selector: '#contentEditor',
  license_key: 'gpl',
  height: 500,
  menubar: true,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
    'insertdatetime', 'media', 'table', 'help', 'wordcount'
  ],
  toolbar:
    'undo redo | blocks | bold italic forecolor backcolor | ' +
    'alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | ' +
    'removeformat | image media link table | code fullscreen help',
  content_style: 'body { font-family:Inter,sans-serif; font-size:15px; line-height:1.6; color:#333; }',
  promotion: false,
  branding: false,
  setup: function (editor) {
    editor.on('change', function () {
      editor.save();
    });
  }
});
</script>
<div class="topbar">
  <div><h1><?= $post ? 'Edit' : 'New' ?> Post</h1></div>
  <a href="<?= base_url('admin/blog') ?>" class="btn-new" style="background:var(--muted)"><i class="fas fa-arrow-left"></i> Back</a>
</div>

<form method="post" action="<?= $post ? base_url('admin/blog/update/' . (int) $post['id']) : base_url('admin/blog/store') ?>" enctype="multipart/form-data">
  <?= csrf_field() ?>
  <div class="settings-group">
    <div class="settings-grid">
      <div class="settings-field"><label>Title</label><input type="text" name="title" value="<?= e($post['title'] ?? '') ?>" required></div>
      <div class="settings-field"><label>Slug</label><input type="text" name="slug" value="<?= e($post['slug'] ?? '') ?>"></div>
      <div class="settings-field"><label>Author</label><input type="text" name="author" value="<?= e($post['author'] ?? '') ?>"></div>
      <div class="settings-field"><label>Category</label><input type="text" name="category" value="<?= e($post['category'] ?? '') ?>" placeholder="e.g. team, travel"></div>
      <div class="settings-field"><label>Published at</label><input type="datetime-local" name="published_at" value="<?= $post ? date('Y-m-d\TH:i', strtotime($post['published_at'])) : date('Y-m-d\TH:i') ?>"></div>
      <div class="settings-field"><label>Featured</label>
        <select name="featured"><option value="1" <?= ($post['featured'] ?? 0) ? 'selected' : '' ?>>Yes</option><option value="0" <?= !($post['featured'] ?? 0) ? 'selected' : '' ?>>No</option></select>
      </div>
      <div class="settings-field"><label>Active</label>
        <select name="active"><option value="1" <?= ($post['active'] ?? 1) ? 'selected' : '' ?>>Yes</option><option value="0" <?= !($post['active'] ?? 1) ? 'selected' : '' ?>>No</option></select>
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Image</h2>
    <div class="settings-field">
      <div class="image-upload-wrap">
        <div class="image-preview <?= ($post && $post['image']) ? '' : 'image-preview-empty' ?>" id="imagePreview">
          <?php if ($post && $post['image']): ?>
            <img src="<?= asset('storage/uploads/' . e($post['image'])) ?>" alt="">
          <?php else: ?>
            <i class="fas fa-image"></i>
            <span>No image</span>
          <?php endif; ?>
        </div>
        <input type="file" name="image" accept="image/png,image/jpeg,image/webp" onchange="previewImage(this, 'imagePreview')">
      </div>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Excerpt</h2>
    <div class="settings-field">
      <textarea name="excerpt" rows="3" style="width:100%;font-size:13px;padding:12px;border:1px solid var(--border);border-radius:8px"><?= e($post['excerpt'] ?? '') ?></textarea>
    </div>
  </div>

  <div class="settings-group">
    <h2 class="settings-group-title">Content (HTML)</h2>
    <div class="settings-field">
      <textarea id="contentEditor" name="content" rows="16" style="width:100%"><?= e($post['content'] ?? '') ?></textarea>
    </div>
  </div>

  <button type="submit" class="btn-new" style="margin-top:16px"><i class="fas fa-save"></i> <?= $post ? 'Update' : 'Create' ?> Post</button>
</form>
