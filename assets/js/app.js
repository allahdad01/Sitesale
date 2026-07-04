document.addEventListener('DOMContentLoaded', function () {
  const navToggle = document.getElementById('navToggle');
  const navLinks  = document.getElementById('navLinks');

  if (navToggle && navLinks) {
    navToggle.addEventListener('click', function () {
      const isOpen = navLinks.classList.toggle('open');
      navToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    navLinks.querySelectorAll('a').forEach(function (a) {
      a.addEventListener('click', function () {
        navLinks.classList.remove('open');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  }

  // === AWARDS CAROUSEL INTERACTION ===
  var awardsEl = document.querySelector('.awards');
  var awardsCarousel = awardsEl ? awardsEl.querySelector('.carousel') : null;
  var awardsItems = awardsEl ? awardsEl.querySelectorAll('.carousel .item') : [];
  var centerEmblem = awardsEl ? awardsEl.querySelector('.center-emblem') : null;
  var awardsScene = awardsEl ? awardsEl.querySelector('.scene') : null;

  function awardsPause() {
    if (awardsCarousel) awardsCarousel.classList.add('paused');
    if (centerEmblem) centerEmblem.classList.add('paused');
  }

  function awardsResume() {
    if (awardsCarousel) awardsCarousel.classList.remove('paused', 'hovered');
    if (centerEmblem) centerEmblem.classList.remove('paused', 'hovered');
    if (awardsItems.length) {
      awardsItems.forEach(function (it) { it.classList.remove('focused', 'dimmed'); });
    }
  }

  if (awardsItems.length && awardsCarousel && awardsScene) {
    // Mousemove on scene: pick item closest to cursor
    awardsScene.addEventListener('mousemove', function (e) {
      var cx = e.clientX;
      var cy = e.clientY;
      var closest = null;
      var closestDist = Infinity;

      awardsItems.forEach(function (it) {
        var r = it.getBoundingClientRect();
        var ix = r.left + r.width / 2;
        var iy = r.top + r.height / 2;
        var d = Math.sqrt((cx - ix) * (cx - ix) + (cy - iy) * (cy - iy));
        if (d < closestDist) { closestDist = d; closest = it; }
      });

      // Only focus if cursor is within ~200px of an item
      if (closest && closestDist < 200) {
        awardsPause();
        awardsCarousel.classList.add('hovered');
        if (centerEmblem) centerEmblem.classList.add('hovered');
        awardsItems.forEach(function (it) {
          it.classList.toggle('focused', it === closest);
          it.classList.toggle('dimmed', it !== closest);
        });
      } else {
        awardsItems.forEach(function (it) { it.classList.remove('focused', 'dimmed'); });
      }
    });

    awardsScene.addEventListener('mouseleave', function () {
      awardsResume();
    });

    // Click any item → modal
    awardsScene.addEventListener('click', function (e) {
      var item = e.target.closest('.item');
      if (!item) return;
      var img = item.querySelector('img');
      var labelEl = item.querySelector('.item-label');
      var modal = document.getElementById('awardsModal');
      var modalImg = document.getElementById('awardsModalImg');
      var modalLabel = document.getElementById('awardsModalLabel');
      if (!modal || !img) return;
      modalImg.src = img.src;
      modalImg.alt = img.alt;
      modalLabel.textContent = labelEl ? labelEl.textContent : '';
      modal.classList.add('open');
      document.body.style.overflow = 'hidden';
    });
  }

  // Modal close handlers
  var modal = document.getElementById('awardsModal');
  var closeBtn = document.getElementById('awardsModalClose');

  function closeModal() {
    if (modal) {
      modal.classList.remove('open');
      document.body.style.overflow = '';
    }
  }

  if (closeBtn) closeBtn.addEventListener('click', closeModal);
  if (modal) modal.addEventListener('click', function (e) {
    if (e.target === modal) closeModal();
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') closeModal();
  });
});
