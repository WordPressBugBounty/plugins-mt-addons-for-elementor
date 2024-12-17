(function ($) {
	'use strict';
	// Create SVG elements
	var leftArrowSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
	leftArrowSVG.setAttribute("xmlns", "http://www.w3.org/2000/svg");
	leftArrowSVG.setAttribute("viewBox", "0 0 448 512");
	var leftArrowPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
	leftArrowPath.setAttribute("d", "M257.5 445.1l-22.2 22.2c-9.4 9.4-24.6 9.4-33.9 0L7 273c-9.4-9.4-9.4-24.6 0-33.9L201.4 44.7c9.4-9.4 24.6-9.4 33.9 0l22.2 22.2c9.5 9.5 9.3 25-.4 34.3L136.6 216H424c13.3 0 24 10.7 24 24v32c0 13.3-10.7 24-24 24H136.6l120.5 114.8c9.8 9.3 10 24.8 .4 34.3z");
	leftArrowSVG.appendChild(leftArrowPath);

	var rightArrowSVG = document.createElementNS("http://www.w3.org/2000/svg", "svg");
	rightArrowSVG.setAttribute("xmlns", "http://www.w3.org/2000/svg");
	rightArrowSVG.setAttribute("viewBox", "0 0 448 512");
	var rightArrowPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
	rightArrowPath.setAttribute("d", "M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L256.5 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L167.1 101.2c-9.8-9.3-10-24.8-.4-34.3z");
	rightArrowSVG.appendChild(rightArrowPath);

    jQuery('.mt-addons-premium-services-carousel-5').owlCarousel({
        navigation      : true, 
        pagination      : false,
        loop            : true,
        navigationText: [leftArrowSVG.outerHTML, rightArrowSVG.outerHTML],
        items : 5,
    });
    jQuery('.mt-addons-premium-services-carousel-4').owlCarousel({
        navigation      : true, 
        pagination      : false,
        loop            : true,
        navigationText: [leftArrowSVG.outerHTML, rightArrowSVG.outerHTML],
        items : 4,
        itemsCustom : [
            [0,     1],
            [450,   1],
            [600,   2],
            [700,   2],
            [1000,  3],
            [1200,  3],
            [1400,  4],
            [1600,  4]
        ]
    })
    jQuery('.mt-addons-premium-services-carousel-3').owlCarousel({
        navigation      : true, 
        pagination      : false,
        loop            : true,
		navigationText: [leftArrowSVG.outerHTML, rightArrowSVG.outerHTML],
        items : 3,   
    })
})();