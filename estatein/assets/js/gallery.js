/**
 * Property detail photo gallery.
 *
 * Pages through the main images (perview at a time) via the prev/next buttons,
 * the thumbnail strip, and keeps the indicator dots + active thumb in sync.
 * Progressive enhancement: with no JS the first page of images is shown.
 */
(function () {
	'use strict';

	function initGallery(gallery) {
		var track = gallery.querySelector('.pd-gallery__track');
		var cells = Array.prototype.slice.call(gallery.querySelectorAll('.pd-gallery__cell'));
		var thumbs = Array.prototype.slice.call(gallery.querySelectorAll('.pd-gallery__thumb'));
		var dots = Array.prototype.slice.call(gallery.querySelectorAll('.pd-gallery__dots i'));
		var prev = gallery.querySelector('[data-gallery-prev]');
		var next = gallery.querySelector('[data-gallery-next]');
		if (!track || !cells.length) {
			return;
		}

		var perView = parseInt(gallery.getAttribute('data-gallery-perview'), 10) || 2;
		var pages = Math.max(1, Math.ceil(cells.length / perView));
		var page = 0;

		function render() {
			var first = cells[Math.min(page * perView, cells.length - 1)];
			track.style.transform = 'translateX(-' + (first ? first.offsetLeft : 0) + 'px)';
			dots.forEach(function (d, i) {
				d.classList.toggle('is-active', i === page);
			});
			thumbs.forEach(function (t, i) {
				t.classList.toggle('is-active', Math.floor(i / perView) === page);
			});
		}

		function goTo(p) {
			page = (p + pages) % pages;
			render();
		}

		if (prev) {
			prev.addEventListener('click', function () { goTo(page - 1); });
		}
		if (next) {
			next.addEventListener('click', function () { goTo(page + 1); });
		}
		thumbs.forEach(function (t, i) {
			t.addEventListener('click', function () { goTo(Math.floor(i / perView)); });
		});
		// Re-measure after layout/resize so the pixel offset stays accurate.
		window.addEventListener('resize', render);
		render();
	}

	function ready() {
		document.querySelectorAll('[data-gallery]').forEach(initGallery);
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', ready);
	} else {
		ready();
	}
})();

/**
 * Auto-fill the CF7 "Selected Property" field on the property-detail inquiry form
 * from the wrapper's data attribute, so the enquiry records which listing it's about.
 */
(function () {
	'use strict';
	function fill() {
		var wrap = document.querySelector('.pd-inquire__form[data-selected-property]');
		if (!wrap) { return; }
		var field = wrap.querySelector('.js-selected-property');
		if (field && !field.value) { field.value = wrap.getAttribute('data-selected-property'); }
	}
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', fill);
	} else {
		fill();
	}
})();
