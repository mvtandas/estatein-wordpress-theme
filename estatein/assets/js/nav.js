/**
 * Mobile navigation toggle.
 * Manages aria-expanded + an is-open class, closes on Escape and on link click.
 */
(function () {
  'use strict';

  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('.site-nav');
  if (!toggle || !nav) return;

  function setOpen(open) {
    toggle.setAttribute('aria-expanded', String(open));
    nav.classList.toggle('is-open', open);
  }

  toggle.addEventListener('click', function () {
    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });

  nav.addEventListener('click', function (e) {
    if (e.target.closest('a')) setOpen(false);
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') setOpen(false);
  });

  // Dismiss the promo banner (Figma close button 60:3099).
  var promo = document.querySelector('[data-promo]');
  var promoClose = document.querySelector('[data-promo-close]');
  if (promo && promoClose) {
    promoClose.addEventListener('click', function () {
      promo.setAttribute('hidden', '');
    });
  }
})();
