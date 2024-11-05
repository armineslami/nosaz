import "./sw.js";
import "flowbite";
import { showPWAInstallPrompt } from "./pwa-install-prompt";
import { showNotificationPermissionRequestPrompt } from "./notification";
import Alpine from "alpinejs";
import axios from "axios";

// https://app.haikei.app
// http://thednp.github.io/kute.js/index.html
// import KUTE from "kute.js";

// Only load the package when required to reduce the the bundle size
window.importHTML2PDF = async function importHTML2PDF() {
    if (!window.html2pdf) {
        const { default: html2pdf } = await import("html2pdf.js");
        window.html2pdf = html2pdf;
    }
};

window.Alpine = Alpine;
// window.KUTE = KUTE;
window.axios = axios;
window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
window.axios.defaults.headers.common["X-CSRF-TOKEN"] = document
    .querySelector('meta[name="csrf-token"]')
    .getAttribute("content");

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

showPWAInstallPrompt();
showNotificationPermissionRequestPrompt();
