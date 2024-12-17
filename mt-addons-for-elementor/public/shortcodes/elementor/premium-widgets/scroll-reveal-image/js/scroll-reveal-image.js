class LargeScrollFeature {
    constructor() {
        this.$sections = document.querySelectorAll("[data-feature-large-scroll-section]");
        this.$stickySection = document.querySelector("[data-feature-large-scroll-sticky-content]");
        this.$activeSection = null;

        if (this.$sections.length > 0) {
            this.setTopForSticky();
            this.initResizeHandler();
            this.initDesktopObserver();
            this.initMobileObserver();
        }
    }

    initMobileObserver() {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    observer.unobserve(entry.target);
                    this.updateMediaSrcForActiveSection(entry.target);
                }
            });
        }, { rootMargin: "0px" });

        this.$sections.forEach(section => {
            observer.observe(section);
        });
    }

    initDesktopObserver() {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    if (this.$activeSection === entry.target) return;
                    this.$activeSection = entry.target;
                    this.updateStickyMedia();
                    this.updateMediaSrcForActiveSection(entry.target.nextElementSibling); // Update media for next section
                }
            });
        }, { rootMargin: "-50% 0% -50% 0%" });

        this.$sections.forEach(section => {
            observer.observe(section);
        });
    }

    initResizeHandler() {
        window.addEventListener(
            "resize",
            throttle(() => {
                if (isDesktop()) this.setTopForSticky();
            }, 100)
        );
    }

    setTopForSticky() {
        const windowHeight = window.innerHeight;
        const stickyHeight = this.$stickySection.offsetHeight;
        const headerHeight = parseInt(getComputedStyle(document.documentElement).getPropertyValue("--header-fixed-height"));
        this.$stickySection.style.top = `${(windowHeight - stickyHeight + headerHeight) / 2}px`;
    }

    updateStickyMedia() {
        this.$stickySection.innerHTML = this.$activeSection.querySelector("[data-feature-large-scroll-section-media]").innerHTML;
    }

    updateMediaSrcForActiveSection(section) {
        if (!section) return; // Check if next section exists
        const { video, image } = this.getAttributesForMedia(section);
        const mediaElement = section.querySelector("[data-feature-large-scroll-section-media]");

        if (video && mediaElement.querySelector("video")) {
            mediaElement.querySelector("video").setAttribute("src", video);
        } else if (image && mediaElement.querySelector("img")) {
            mediaElement.querySelector("img").setAttribute("src", image);
        }
    }

    getAttributesForMedia(section) {
        return {
            video: section.getAttribute("data-video"),
            image: section.getAttribute("data-image")
        };
    }
}

function isDesktop() {
    return window.innerWidth > 768; // Adjust this breakpoint if needed
}

function throttle(func, limit) {
    let inThrottle;
    return function () {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// Instantiate the LargeScrollFeature class
document.addEventListener("DOMContentLoaded", () => {
    new LargeScrollFeature();
});
