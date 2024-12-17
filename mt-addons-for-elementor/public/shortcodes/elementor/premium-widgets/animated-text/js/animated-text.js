(function( $ ) {
    'use strict';

    $(document).ready(function () {
        MTAP_Animated_Text_On_Hover.init();
    });
     
    var MTAP_Animated_Text_On_Hover = {
        init: function () {
            var selector = $('.mtap-hover .mt-addons-premium-animated-text-inner');

            if (selector.length) {
                const speed = 10;
                const moveBackground = (event) => {
                    let mouseXPos = (event.pageX / $(window).width()) * 100;
                    let mouseYPos = (event.pageY / $(window).height()) * 100;
                    $('.mtap-hover .mt-addons-premium-animated-text-inner').css('backgroundPosition', `${mouseXPos / speed}% ${mouseYPos / speed}%`);
                }
                $('.mtap-hover').on('mousemove', moveBackground);
            }
        }
    };


})( jQuery );
