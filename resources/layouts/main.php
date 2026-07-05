<?php use App\Core\View; ?>
<!DOCTYPE html>
<html lang="<?= locale_lang() ?>" dir="<?= locale_dir() ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php $favicon = setting('favicon', ''); if ($favicon): ?>
<link rel="icon" type="image/x-icon" href="<?= asset('storage/uploads/' . e($favicon)) ?>">
<link rel="shortcut icon" type="image/x-icon" href="<?= asset('storage/uploads/' . e($favicon)) ?>">
<?php else: ?>
<link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🕋</text></svg>">
<?php endif; ?>
<title><?= e($title ?? setting('site_name', 'Al Moqadas Travel Agency')) ?></title>
<meta name="description" content="<?= e($description ?? setting('meta_description', 'Premium Hajj & Umrah packages, worldwide flights, visa services, and curated travel experiences.')) ?>">
<meta name="keywords" content="<?= e(setting('meta_keywords', 'Hajj, Umrah, travel agency, flights, visa, Afghanistan')) ?>">
<?php $gaId = setting('google_analytics_id', ''); if ($gaId): ?>
<script async src="https://www.googletagmanager.com/gtag/js?id=<?= e($gaId) ?>"></script>
<script>window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);}gtag('js',new Date());gtag('config','<?= e($gaId) ?>');</script>
<?php endif; ?>
<link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Cinzel:wght@400;600;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="<?= asset('assets/css/app.css') ?>">
<?php if (locale_dir() === 'rtl'): ?>
<link rel="stylesheet" href="<?= asset('assets/css/rtl.css') ?>">
<?php endif; ?>
<style>
:root {
  --primary: <?= e(setting('color_primary', '#FE590B')) ?>;
  --primary-dark: <?= e(setting('color_primary_dark', '#d44500')) ?>;
  --primary-light: <?= e(setting('color_primary_light', '#ff7a38')) ?>;
  --navy: <?= e(setting('color_navy', '#2A2A68')) ?>;
  --navy-dark: <?= e(setting('color_navy_dark', '#1e1e50')) ?>;
  --navy-light: <?= e(setting('color_navy_light', '#38388a')) ?>;
  --bg: <?= e(setting('color_bg', '#D3D3D3')) ?>;
  --bg2: <?= e(setting('color_bg2', '#bebebe')) ?>;
}
</style>
</head>
<body>

<a href="#main-content" class="skip-link">Skip to main content</a>

<?php View::partial('navbar', ['current_page' => $current_page ?? '']) ?>

<main id="main-content">
  <?= $content ?>
</main>

<?php View::partial('footer') ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>
<script src="<?= asset('assets/js/app.js') ?>"></script>

<?php if (isset($page_scripts)): ?>
  <?= $page_scripts ?>
<?php endif; ?>

</body>
</html>
