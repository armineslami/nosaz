if (navigator && "serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("/service-worker.js")
        .then((reg) => {
            // console.log("Service Worker registered!", reg);

            // Check if there's an existing service worker controlling the page
            const isFirstInstall = !navigator.serviceWorker.controller;

            reg.onupdatefound = () => {
                const newWorker = reg.installing;
                newWorker.onstatechange = () => {
                    /**
                     * Check if the new service worker has been activated and is controlling the page.
                     * If there is a activated service controller and this is not the first install,
                     * show a prompt to the user to inform that an app update is installed.
                     */
                    if (newWorker.state === "activated" && !isFirstInstall) {
                        // Display a message to let the user know about the update
                        const event = new CustomEvent("open-modal", {
                            detail: "update-app-prompt",
                            bubbles: true,
                            cancelable: true,
                        });
                        window.dispatchEvent(event);
                    }
                };
            };
        })
        .catch((err) => {
            // console.error("Service Worker registration failed:", err);
        });
}
