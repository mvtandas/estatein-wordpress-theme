/**
 * Property archive filters enhancement.
 * Auto-submits the GET form when a select changes, so the page reloads with the
 * chosen taxonomy filters. Without JS the explicit Search button still works.
 */
(function () {
  'use strict';

  var form = document.querySelector('[data-filters]');
  if (!form) return;

  form.querySelectorAll('select').forEach(function (select) {
    select.addEventListener('change', function () {
      form.submit();
    });
  });
})();
