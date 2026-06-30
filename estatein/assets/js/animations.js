/**
 * Premium motion layer (GSAP + ScrollTrigger).
 *
 * Uses gsap.from()/fromTo() so initial states are applied by JS — if GSAP fails
 * to load or motion is reduced, all content stays fully visible. No CSS hides it.
 */
(function () {
  'use strict';

  if (!window.gsap) return;
  // Respect users who prefer reduced motion — show everything, animate nothing.
  if (window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var gsap = window.gsap;
  if (window.ScrollTrigger) gsap.registerPlugin(window.ScrollTrigger);

  var hasST = !!window.ScrollTrigger;

  /* ---- Hero entrance timeline ---- */
  var tl = gsap.timeline({ defaults: { ease: 'power3.out', duration: 0.9 } });
  if (document.querySelector('.hero__media img')) {
    tl.from('.hero__media img', { scale: 1.14, duration: 1.5, ease: 'power2.out' }, 0);
  }
  tl.from('.hero__title', { y: 42, opacity: 0 }, 0.1)
    .from('.hero__lede', { y: 30, opacity: 0 }, '-=0.6')
    .from('.hero__actions .btn', { y: 22, opacity: 0, stagger: 0.12 }, '-=0.5')
    .from('.hero__stat', { y: 26, opacity: 0, stagger: 0.12 }, '-=0.4');
  if (document.querySelector('.hero__badge')) {
    tl.from('.hero__badge', { scale: 0.5, opacity: 0, duration: 0.8, ease: 'back.out(1.7)' }, '-=0.7');
  }

  if (!hasST) return; // entrance still runs; scroll effects need ScrollTrigger

  /* ---- Generic scroll reveal ---- */
  function reveal(selector, vars) {
    gsap.utils.toArray(selector).forEach(function (el) {
      gsap.from(el, Object.assign({
        scrollTrigger: { trigger: el, start: 'top 86%' },
        y: 40, opacity: 0, duration: 0.8, ease: 'power3.out'
      }, vars || {}));
    });
  }

  reveal('.section-header');
  reveal('.cta-banner__inner', { y: 32 });
  reveal('.page-hero', { y: 24 });

  /* ---- Staggered groups (cards) ---- */
  gsap.utils.toArray(
    '.feature-strip__inner, .slider__track, .property-grid, .service-grid, .post-grid, .team-grid, .faq-grid, .site-footer__cols'
  ).forEach(function (group) {
    var items = group.children;
    if (!items.length) return;
    gsap.from(items, {
      scrollTrigger: { trigger: group, start: 'top 82%' },
      y: 48, opacity: 0, duration: 0.7, stagger: 0.12, ease: 'power3.out'
    });
  });

  /* ---- Stat count-up (200+, 10k+, 16+) ---- */
  gsap.utils.toArray('.hero__stat-value').forEach(function (el) {
    var m = el.textContent.trim().match(/^([\d.]+)(.*)$/);
    if (!m) return;
    var target = parseFloat(m[1]);
    var suffix = m[2];
    var decimals = (m[1].split('.')[1] || '').length;
    var obj = { val: 0 };
    gsap.to(obj, {
      val: target, duration: 1.6, ease: 'power1.out',
      scrollTrigger: { trigger: el, start: 'top 92%' },
      onUpdate: function () { el.textContent = obj.val.toFixed(decimals) + suffix; }
    });
  });

  /* ---- Subtle parallax on the hero photo ---- */
  if (document.querySelector('.hero__media img')) {
    gsap.to('.hero__media img', {
      yPercent: 6, ease: 'none',
      scrollTrigger: { trigger: '.hero', start: 'top top', end: 'bottom top', scrub: true }
    });
  }
})();
