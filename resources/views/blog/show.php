<article class="blog-article">

  <?php if ($post['image']): ?>
  <div class="article-hero">
    <img src="<?= asset('storage/uploads/' . e($post['image'])) ?>" alt="<?= e($post['title']) ?>">
    <div class="article-hero-overlay"></div>
  </div>
  <?php endif; ?>

  <div class="article-layout">

    <div class="article-main">
      <div class="article-breadcrumb">
        <a href="<?= base_url('blog') ?>"><i class="fas fa-arrow-left"></i> Back to Blog</a>
      </div>

      <?php if ($post['category']): ?>
        <div class="article-categories">
          <span class="article-category"><?= e($post['category']) ?></span>
        </div>
      <?php endif; ?>

      <h1 class="article-title"><?= e($post['title']) ?></h1>

      <div class="article-meta-bar">
        <div class="article-author">
          <?php if ($post['author']): ?>
            <div class="article-avatar"><i class="fas fa-user-circle"></i></div>
            <div class="article-author-info">
              <span class="article-author-name"><?= e($post['author']) ?></span>
              <?php if ($post['published_at']): ?>
                <span class="article-date"><?= date('F j, Y', strtotime($post['published_at'])) ?></span>
              <?php endif; ?>
            </div>
          <?php elseif ($post['published_at']): ?>
            <div class="article-avatar"><i class="fas fa-calendar"></i></div>
            <span class="article-date"><?= date('F j, Y', strtotime($post['published_at'])) ?></span>
          <?php endif; ?>
        </div>
        <div class="article-share">
          <span>Share</span>
          <button onclick="shareUrl('facebook')" aria-label="Facebook"><i class="fab fa-facebook-f"></i></button>
          <button onclick="shareUrl('twitter')" aria-label="Twitter"><i class="fab fa-x-twitter"></i></button>
          <button onclick="shareUrl('linkedin')" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></button>
          <button onclick="shareUrl('copy')" aria-label="Copy link"><i class="fas fa-link"></i></button>
        </div>
      </div>

      <div class="article-body">
        <?php if ($post['excerpt']): ?>
          <div class="article-excerpt"><p><?= e($post['excerpt']) ?></p></div>
        <?php endif; ?>
        <div class="article-text"><?= $post['content'] ?></div>
      </div>

      <div class="article-footer-bar">
        <div class="article-tags">
          <?php if ($post['category']): ?><span class="tag"><?= e($post['category']) ?></span><?php endif; ?>
        </div>
        <div class="article-share-footer">
          <span>Share:</span>
          <button onclick="shareUrl('facebook')" aria-label="Facebook"><i class="fab fa-facebook-f"></i></button>
          <button onclick="shareUrl('twitter')" aria-label="Twitter"><i class="fab fa-x-twitter"></i></button>
          <button onclick="shareUrl('linkedin')" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></button>
        </div>
      </div>

      <div class="article-nav">
        <a href="<?= base_url('blog') ?>" class="article-nav-back"><i class="fas fa-arrow-left"></i> All Articles</a>
      </div>
    </div>

    <?php if (!empty($recentPosts)): ?>
    <aside class="article-sidebar">
      <div class="sidebar-widget">
        <h3 class="sidebar-title">Recent Articles</h3>
        <div class="sidebar-posts">
          <?php foreach ($recentPosts as $rp): ?>
            <a href="<?= base_url('blog/' . e($rp['slug'])) ?>" class="sidebar-post">
              <?php if ($rp['image']): ?>
                <div class="sidebar-post-img">
                  <img src="<?= asset('storage/uploads/' . e($rp['image'])) ?>" alt="<?= e($rp['title']) ?>">
                </div>
              <?php endif; ?>
              <div class="sidebar-post-body">
                <?php if ($rp['category']): ?><span class="sidebar-post-cat"><?= e($rp['category']) ?></span><?php endif; ?>
                <h4 class="sidebar-post-title"><?= e($rp['title']) ?></h4>
                <?php if ($rp['published_at']): ?>
                  <span class="sidebar-post-date"><?= date('M j, Y', strtotime($rp['published_at'])) ?></span>
                <?php endif; ?>
              </div>
            </a>
          <?php endforeach; ?>
        </div>
      </div>
    </aside>
    <?php endif; ?>

  </div>
</article>

<div id="readingProgress" class="reading-progress"><div class="reading-progress-bar" id="readingProgressBar"></div></div>

<script>
function shareUrl(platform) {
  var url = encodeURIComponent(window.location.href);
  var title = encodeURIComponent(document.title);
  var urls = {
    facebook: 'https://www.facebook.com/sharer/sharer.php?u=' + url,
    twitter: 'https://twitter.com/intent/tweet?text=' + title + '&url=' + url,
    linkedin: 'https://www.linkedin.com/shareArticle?mini=true&url=' + url + '&title=' + title,
  };
  if (platform === 'copy') {
    navigator.clipboard.writeText(window.location.href).then(function () {
      var btn = document.querySelector('.article-share button[onclick*="copy"]');
      if (btn) { var orig = btn.innerHTML; btn.innerHTML = '<i class="fas fa-check"></i>'; setTimeout(function () { btn.innerHTML = orig; }, 2000); }
    });
    return;
  }
  if (urls[platform]) window.open(urls[platform], '_blank', 'width=600,height=400');
}

var progressBar = document.getElementById('readingProgressBar');
if (progressBar) {
  window.addEventListener('scroll', function () {
    var scrollTop = window.scrollY;
    var docHeight = document.documentElement.scrollHeight - window.innerHeight;
    var progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
    progressBar.style.width = progress + '%';
  });
}
</script>
