import Firebase from "./firebase";

export function showNotificationPermissionRequestPrompt() {
    if (!window || !navigator || !navigator.serviceWorker || !Notification) {
        return;
    }

    const permission = Notification.permission;

    if (permission === "granted") {
        /**
         * Sometimes like the first time installation on chrome, permission for
         * for the domain is granted, but local storage value is not set (since it's first time installation)
         */
        localStorage.setItem("notification-permission-requested", true);
        new Firebase().init();
    } else if (
        localStorage.getItem("notification-permission-requested") === null ||
        (permission === "default" &&
            localStorage.getItem("notification-permission-requested") ===
                "true")
    ) {
        document.addEventListener("DOMContentLoaded", function () {
            /**
             * iOS requests a user gesture to show notification permission request window.
             * So we are going to show a modal to the client and get user's action by
             * clicking(touching) a confirmation button.
             * Also to have a matching UX across other platforms, the same modal will be shown to clients on Android/chrome too.
             * We show a modal to ask for the permission.
             * Then after the user closed the modal, firebase class will be initiated to show
             * the user, the browser native permission window.
             */
            const event = new CustomEvent("open-modal", {
                detail: "notification-permission-request",
                bubbles: true,
                cancelable: true,
            });
            window.dispatchEvent(event);
            window.addEventListener("modal-closed", (event) => {
                const modalName = event.detail;
                if (modalName === "notification-permission-request") {
                    new Firebase().init();
                    localStorage.setItem(
                        "notification-permission-requested",
                        true
                    );
                }
            });
        });
    }
}
