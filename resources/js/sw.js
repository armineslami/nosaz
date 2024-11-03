if ("serviceWorker" in navigator) {
    navigator.serviceWorker
        .register("/service-worker.js")
        .then((reg) => {
            // console.log("Service Worker registered!", reg);
            reg.onupdatefound = () => {
                const newWorker = reg.installing;
                newWorker.onstatechange = () => {
                    if (
                        newWorker.state === "activated" &&
                        navigator.serviceWorker.controller
                    ) {
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
