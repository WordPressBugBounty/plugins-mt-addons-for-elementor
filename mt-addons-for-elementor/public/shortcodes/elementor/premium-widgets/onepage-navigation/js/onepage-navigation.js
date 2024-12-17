/*
 Project author:     ModelTheme
 File name:          OnePage Navigation
*/

(function($) {
"use strict";
 var elm = document.querySelector('#mtap-onepage-navigation');
    var ms = new MenuSpy(elm, {
        hashTimeout: 200,
        threshold: 300
    });
})(jQuery);