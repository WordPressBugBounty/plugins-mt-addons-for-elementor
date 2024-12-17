(function($) {
"use strict";
  // Select tab content and tab items
  let tabContent = document.querySelectorAll(".mapt-inner");
  let tabItem = document.querySelectorAll(".mapt-item");

  // Add class 'mapt-inner_hidden' to all tab content except the first one
  for (let i = 1; i < tabContent.length; i++) {
    tabContent[i].classList.add("mapt-inner_hidden");
  }

  // Add class 'mapt-item_active' to the first tab item
  tabItem[0].classList.add("mapt-item_active");

  // For each tab item
  for (let i = 0; i < tabItem.length; i++) {
    // Add event listener to handle tab switching on hover
    tabItem[i].addEventListener("mouseover", () => {
      // Hide all tab content
      tabContent.forEach((item) => {
        item.classList.add("mapt-inner_hidden");
      });
      // Remove 'mapt-item_active' class from all tab items
      tabItem.forEach((item) => {
        item.classList.remove("mapt-item_active");
      });
      // Show the hovered tab content and mark the hovered tab item as active
      tabContent[i].classList.remove("mapt-inner_hidden");
      tabItem[i].classList.add("mapt-item_active");
    });
  }
})(jQuery);
