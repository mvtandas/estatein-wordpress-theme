/**
 * Lightweight testimonial slider.
 * Translates the track by one "page" of visible slides. Respects the count set
 * via data-slider-perview and is keyboard-operable through the prev/next buttons.
 */
(function () {
  'use strict';

  document.querySelectorAll('[data-slider]').forEach(function (slider) {
    var track = slider.querySelector('.slider__track');
    var slides = slider.querySelectorAll('.slider__slide');
    var prev = slider.querySelector('[data-slider-prev]');
    var next = slider.querySelector('[data-slider-next]');
    if (!track || !slides.length) return;

    var index = 0;

    function perView() {
      if (window.matchMedia('(max-width: 768px)').matches) return 1;
      if (window.matchMedia('(max-width: 1024px)').matches) return 2;
      return parseInt(slider.getAttribute('data-slider-perview'), 10) || 3;
    }

    function maxIndex() {
      return Math.max(0, slides.length - perView());
    }

    function update() {
      index = Math.min(index, maxIndex());
      var slideWidth = slides[0].getBoundingClientRect().width;
      var gap = parseFloat(getComputedStyle(track).columnGap || getComputedStyle(track).gap || 0) || 0;
      track.style.transform = 'translateX(' + (-(slideWidth + gap) * index) + 'px)';
      if (prev) prev.disabled = index === 0;
      if (next) next.disabled = index >= maxIndex();
    }

    if (prev) prev.addEventListener('click', function () { index = Math.max(0, index - 1); update(); });
    if (next) next.addEventListener('click', function () { index = Math.min(maxIndex(), index + 1); update(); });
    window.addEventListener('resize', update);
    update();
  });
})();
