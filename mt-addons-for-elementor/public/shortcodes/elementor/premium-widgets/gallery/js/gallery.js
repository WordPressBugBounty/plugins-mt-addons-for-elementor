(function($) {
"use strict";
  const imgContent = document.querySelectorAll('.map-img-content-hover');
  function showImgContent(e) {
    const offsetX = 15;
    const offsetY = 15; 
    for (let i = 0; i < imgContent.length; i++) {
      const x = e.pageX + offsetX;
      const y = e.pageY + offsetY;
      imgContent[i].style.transform = `translate3d(${x}px, ${y}px, 0)`;
    }
  }
  document.addEventListener('mousemove', showImgContent);
})(jQuery);
