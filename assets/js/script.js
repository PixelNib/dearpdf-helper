jQuery(document).ready(function() {
  jQuery('div.ast-container').attr('id', 'pdf-container');
  jQuery('div#pdf-container').addClass("container");
  jQuery('div#pdf-container').removeClass("ast-container");
  // jQuery( "select#book-series" ).prepend( "<option selected style='display:none'>Open this to select book</option>" );
});

// (function () {
//     'use strict'
//     var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
//     tooltipTriggerList.forEach(function (tooltipTriggerEl) {
//       new bootstrap.Tooltip(tooltipTriggerEl)
//     })
//   })();

jQuery(document).ready(function($){
  $("#book-series").change(function () {
    $("#btn-for-book").attr('href', this.value);
  });
});