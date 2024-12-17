(function($) {
  "use strict";

  var swiper = new Swiper('.mapbcs', {
    spaceBetween: 30,
    effect: 'fade',
    loop: true,
    mousewheel: {
      invert: false,
    },
    // autoHeight: true,
    pagination: {
      el: '.mapbcs-pagination',
      clickable: true,
    }
  });
})(jQuery);