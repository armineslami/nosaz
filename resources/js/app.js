import "./bootstrap";
import "flowbite";

import Alpine from "alpinejs";

// https://app.haikei.app
// http://thednp.github.io/kute.js/index.html
import KUTE from "kute.js";

window.Alpine = Alpine;
window.KUTE = KUTE;

Alpine.start();

/**
 * Css hover to apply negative translate on touch screen devices is not working
 * properly beucase mouseleave is not called on touch screen devices to deactive the hover style.
 * Using following js code adds .active class to buttons and this class is defined in app.css.
 */
document
    .querySelectorAll(".primary-button, .secondary-button, .danger-button")
    .forEach((button) => {
        let touchTimeout;

        button.addEventListener("mouseenter", () => {
            if (touchTimeout !== null) {
                button.classList.add("active");
            }
        });

        button.addEventListener("touchstart", () => {
            touchTimeout = setTimeout(() => {
                touchTimeout = null; // Reset the timeout reference
            }, 50); // Short delay to prevent mouseenter firing

            button.classList.add("active");
        });

        button.addEventListener("touchend", () => {
            setTimeout(() => {
                button.classList.remove("active");
            }, 200); // Adjust timeout as needed
        });

        button.addEventListener("mouseleave", () => {
            button.classList.remove("active");
        });
    });
