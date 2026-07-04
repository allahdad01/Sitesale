<?php
  $featuredIdx = null;
  foreach ($posts as $idx => $p) { if ($p['featured']) { $featuredIdx = $idx; break; } }
  if ($featuredIdx === null) $featuredIdx = 0;
  $featuredPost = !empty($posts) ? $posts[$featuredIdx] : null;
  $otherPosts = $featuredPost ? array_values(array_filter($posts, fn($p, $i) => $i !== $featuredIdx, ARRAY_FILTER_USE_BOTH)) : [];
?>
<section class="page-hero">
  <div class="hero-ring hero-ring-1"></div>
  <div class="hero-ring hero-ring-2"></div>
  <div class="hero-ring hero-ring-3"></div>

  <div class="hero-badge"><i class="fas fa-newspaper"></i> From the Journal</div>

  <h1>Notes for the<br><span class="orange">Journey Ahead</span></h1>

  <p class="hero-sub">Guidance, rituals, and practical checklists from pilgrims and scholars who've made the trip before you.</p>

  <div class="breadcrumb">
    <span>Home</span> <span>/</span> <span class="current">Blog</span>
  </div>
</section>

<section class="blog-section" id="blog">
  <div class="blog-header">
    <div>
      <span class="eyebrow">Latest Articles</span>
      <h2 class="section-title">All Posts</h2>
      <p class="section-intro">Travel tips, guides, and updates from Al Moqadas.</p>
    </div>
  </div>

  <?php if (empty($posts)): ?>
    <p style="text-align:center;color:var(--muted);max-width:1180px;margin:0 auto;">No posts yet. Check back soon!</p>
  <?php else: ?>
    <div class="blog-wrap">
      <a href="<?= base_url('blog/' . e($featuredPost['slug'])) ?>" class="blog-featured<?= $featuredPost['image'] ? ' has-img' : '' ?>"<?php if ($featuredPost['image']): ?> style="background-image:url('<?= asset('storage/uploads/' . e($featuredPost['image'])) ?>')"<?php endif; ?>>
        <span class="eyebrow"><?= e($featuredPost['category'] ?: 'Featured') ?></span>
        <h3><?= e($featuredPost['title']) ?></h3>
        <p><?= e($featuredPost['excerpt'] ?: mb_substr(strip_tags($featuredPost['content']), 0, 150)) ?></p>
        <span class="read-link">Read the guide →</span>
      </a>

      <div class="blog-list">
        <?php foreach ($otherPosts as $pi => $op): ?>
        <a href="<?= base_url('blog/' . e($op['slug'])) ?>" class="blog-item">
          <div class="blog-item-arch"><span><?= str_pad($pi + 1, 2, '0', STR_PAD_LEFT) ?></span></div>
          <div>
            <h4 class="blog-item-title"><?= e($op['title']) ?></h4>
            <span class="blog-item-meta"><?= e($op['category'] ?: 'Article') . ($op['published_at'] ? ' · ' . date('j M Y', strtotime($op['published_at'])) : '') ?></span>
          </div>
        </a>
        <?php endforeach; ?>
      </div>
    </div>
  <?php endif; ?>
</section>

<style>
.blog-section {
  background: var(--white);
  background-image: none;
}
.blog-section .eyebrow { color: var(--primary); }
.blog-section h2.section-title { color: var(--navy); }
.blog-section .section-intro { color: var(--muted); }

.blog-featured {
  background-color: var(--bg);
  border-radius: 4px;
  position: relative;
}
.blog-featured { background-color: var(--bg); }
.blog-featured h3 { color: var(--navy); }
.blog-featured p { color: var(--muted); }
.blog-featured::before { border-color: rgba(254,89,11,0.2); }
.blog-featured.has-img h3,
.blog-featured.has-img p,
.blog-featured.has-img .eyebrow { color: var(--white); }

.blog-item { border-bottom-color: rgba(0,0,0,0.08); }
.blog-item-title { color: var(--navy); }
.blog-item-meta { color: var(--muted); }
</style>
