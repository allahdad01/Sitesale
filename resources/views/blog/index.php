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

  <div class="hero-badge"><i class="fas fa-newspaper"></i> <?= __('blog.eyebrow') ?></div>

  <h1><?= __('blog.title') ?></h1>

  <p class="hero-sub"><?= __('blog.desc') ?></p>

  <div class="breadcrumb">
    <span><?= __('contact_page.breadcrumb_home') ?></span> <span>/</span> <span class="current"><?= __('nav.blog') ?></span>
  </div>
</section>

<section class="blog-section" id="blog">
  <div class="blog-header">
    <div>
      <span class="eyebrow"><?= __('blog.latest') ?></span>
      <h2 class="section-title"><?= __('blog.all_posts') ?></h2>
      <p class="section-intro"><?= __('blog.desc') ?></p>
    </div>
  </div>

  <?php if (empty($posts)): ?>
    <p style="text-align:center;color:var(--muted);max-width:1180px;margin:0 auto;"><?= __('blog.no_posts') ?></p>
  <?php else: ?>
    <div class="blog-wrap">
      <a href="<?= base_url('blog/' . e($featuredPost['slug'])) ?>" class="blog-featured<?= $featuredPost['image'] ? ' has-img' : '' ?>"<?php if ($featuredPost['image']): ?> style="background-image:url('<?= asset('storage/uploads/' . e($featuredPost['image'])) ?>')"<?php endif; ?>>
        <span class="eyebrow"><?= e($featuredPost['category'] ?: __('blog.featured')) ?></span>
        <h3><?= locale_val_e($featuredPost, 'title') ?></h3>
        <p><?= locale_val_e($featuredPost, 'excerpt', mb_substr(strip_tags(locale_val($featuredPost, 'content')), 0, 150)) ?></p>
        <span class="read-link"><?= __('blog.read_guide') ?></span>
      </a>

      <div class="blog-list">
        <?php foreach ($otherPosts as $pi => $op): ?>
        <a href="<?= base_url('blog/' . e($op['slug'])) ?>" class="blog-item">
          <div class="blog-item-arch"><span><?= str_pad($pi + 1, 2, '0', STR_PAD_LEFT) ?></span></div>
          <div>
            <h4 class="blog-item-title"><?= locale_val_e($op, 'title') ?></h4>
            <span class="blog-item-meta"><?= e($op['category'] ?: __('blog.article')) . ($op['published_at'] ? ' · ' . date('j M Y', strtotime($op['published_at'])) : '') ?></span>
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
