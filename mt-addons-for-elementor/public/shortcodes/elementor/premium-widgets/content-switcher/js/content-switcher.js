"use strict";
jQuery(document).ready(function ($) {
    // Function to initialize content switcher
    function initializeContentSwitcher() {
        $(".mapcs-switcher-wrapper").each(function () {
            var l = $(this);

            if ("button" == l.data("design-type")) {
                var n = l.find(".mapcs-button"),
                    a = l.find(".mapcs-content-section");

                n.each(function () {
                    $(this).on("click", function (e) {
                        e.preventDefault();

                        if (!$(this).hasClass("active")) {
                            n.removeClass("active");
                            $(this).addClass("active");
                            a.removeClass("active");
                            var contentId = $(this).data("content-id");
                            l.find("#" + contentId).addClass("active");
                        }
                    });
                });
            } else {
                var switchLabel = l.find(".mapcs-switch.mapcs-input-label"),
                    toggleSwitch = l.find("input.mapcs-toggle-switch"),
                    primarySwitch = l.find(".mapcs-switch.primary"),
                    secondarySwitch = l.find(".mapcs-switch.secondary"),
                    primaryContent = l.find(".mapcs-content-section.primary"),
                    secondaryContent = l.find(".mapcs-content-section.secondary");

                switchLabel.on("click", function () {
                    if (toggleSwitch.is(":checked")) {
                        primarySwitch.removeClass("active");
                        primaryContent.removeClass("active");
                        secondarySwitch.addClass("active");
                        secondaryContent.addClass("active");
                    } else {
                        secondarySwitch.removeClass("active");
                        secondaryContent.removeClass("active");
                        primarySwitch.addClass("active");
                        primaryContent.addClass("active");
                    }
                });
            }
        });
    }

    // Call the function to initialize content switcher
    initializeContentSwitcher();
});