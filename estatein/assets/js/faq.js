/**
 * FAQ accordion enhancement.
 * Uses native <details> for baseline a11y; this only enforces single-open
 * behaviour within a .faq-list group. No JS == still fully usable.
 */
(function () {
  'use strict';

  var lists = document.querySelectorAll('.faq-list');
  lists.forEach(function (list) {
    var items = list.querySelectorAll('details.faq-item');
    items.forEach(function (item) {
      item.addEventListener('toggle', function () {
        if (!item.open) return;
        items.forEach(function (other) {
          if (other !== item) other.open = false;
        });
      });
    });
  });
})();
