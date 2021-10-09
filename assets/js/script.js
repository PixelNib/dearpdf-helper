jQuery(document).ready(function($) {
    $('div.ast-container').attr('id', 'pdf-container');
    $('div#pdf-container').addClass("container");
    $('div#pdf-container').removeClass("ast-container");
});

(function () {
    'use strict'
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
      new bootstrap.Tooltip(tooltipTriggerEl)
    })
  })()