// Detects if the user's device is on iOS.
const isIos = () => {
    const userAgent = window.navigator.userAgent.toLowerCase();
    return /iphone|ipad|ipod|android/.test(userAgent);
};

// Detects if the user's device is on Android.
const isAndroid = () => {
    const userAgent = window.navigator.userAgent.toLowerCase();
    return /android/.test(userAgent);
};

// Detects if user's device is in standalone mode.
const isInStandaloneMode = () => {
    return "standalone" in window.navigator && window.navigator.standalone;
};

// Detects of user's browser is safari
const isSafari = () => {
    return !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
};

const showPrompt = (os) => {
    // const modalElement = document.querySelector(".pwa-install-prompt");
    const event = new CustomEvent("open-modal", {
        detail: os + "-pwa-install-prompt",
        bubbles: true,
        cancelable: true,
    });
    window.dispatchEvent(event);
    localStorage.setItem("install-prompt-appeared", true);
};

export function showPWAInstallPrompt() {
    if (!window || !window.navigator || !window.navigator.userAgent) {
        return;
    }

    /**
     * This event is fired on Android/Chrome when PWA is detected to infrom the user that
     * the app can be installed as standalone mode. This event is fired only when the app is serverd over HTTPS.
     */
    window.addEventListener("beforeinstallprompt", (e) => {
        /** This is an experimental api.
         * For now i use my own check for android and ios devices using user agent.
         * @link {https://developer.mozilla.org/en-US/docs/Web/API/BeforeInstallPromptEvent} */
        // e.preventDefault();
    });

    // Since `beforeinstallprompt` event is experimental, we manually check for user agent
    if (
        (localStorage.getItem("install-prompt-appeared") === null ||
            localStorage.getItem("install-prompt-appeared") === false) &&
        !isInStandaloneMode()
    ) {
        if (isAndroid()) {
            showPrompt("android");
        }
        // Only safari has the add to home screen option
        else if (isSafari && isIos() && !isInStandaloneMode()) {
            showPrompt("ios");
        }
    }
}
