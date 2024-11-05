import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

// let messaging = null;

// initialize();

// function initialize() {
//     console.log("==>", "serviceWorker" in navigator);
//     if (
//         !("serviceWorker" in navigator) ||
//         !("Notification" in window) ||
//         !("PushManager" in window)
//     ) {
//         console.log("Browser does not support sending notification");
//         return;
//     }

//     /**
//      * FCM Initialization
//      */

//     const firebaseConfig = {
//         apiKey: "AIzaSyByJLWSl0XUpzRZHPQRf9x2fJmO6TXsvWM",
//         authDomain: "nosaz-8e631.firebaseapp.com",
//         projectId: "nosaz-8e631",
//         storageBucket: "nosaz-8e631.firebasestorage.app",
//         messagingSenderId: "759253213886",
//         appId: "1:759253213886:web:c5395d715677944b9274ef",
//         measurementId: "G-EMYZQPB5F9",
//     };

//     // Initialize Firebase
//     const app = initializeApp(firebaseConfig);
//     messaging = getMessaging(app);

//     registerServiceWorker();
// }

/**
 * FCM Initialization
 */

const firebaseConfig = {
    apiKey: "AIzaSyByJLWSl0XUpzRZHPQRf9x2fJmO6TXsvWM",
    authDomain: "nosaz-8e631.firebaseapp.com",
    projectId: "nosaz-8e631",
    storageBucket: "nosaz-8e631.firebasestorage.app",
    messagingSenderId: "759253213886",
    appId: "1:759253213886:web:c5395d715677944b9274ef",
    measurementId: "G-EMYZQPB5F9",
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const messaging = getMessaging(app);

registerServiceWorker();

// Register the service worker and then get the FCM token
async function registerServiceWorker() {
    try {
        const registration = await navigator.serviceWorker.register(
            "/firebase-messaging-sw.js",
            { scope: "fcm" }
        );
        console.log(
            "Service Worker registered with scope:",
            registration.scope
        );

        // Wait until the service worker takes control
        if (!navigator.serviceWorker.controller) {
            await new Promise((resolve) => {
                navigator.serviceWorker.addEventListener(
                    "controllerchange",
                    resolve,
                    { once: true }
                );
            });
            console.log("Service Worker is now controlling the page.");
        }

        // Safe to retrieve FCM token after the service worker is active
        await getFCMToken();
    } catch (error) {
        console.error("Service Worker registration failed:", error);
    }
}

async function getFCMToken(retries = 3) {
    try {
        const token = await getToken(messaging, {
            vapidKey:
                "BK86acGo2FOs2DBFwH4dC8YDg3TT0XbnLty0_alSPjcrUk0AjjRZGTomqbsoVEdMbB6Mlyy0QE6fsltBUdGuuQM",
        });

        if (token) {
            console.log("FCM Token:", token);
            // Send token to server if necessary
        } else {
            console.log(
                "No registration token available. Requesting permission."
            );
            await requestNotificationPermission();
        }
    } catch (error) {
        if (retries > 0 && error.name === "AbortError") {
            console.log(
                "Retrying token retrieval due to service worker readiness issue..."
            );
            setTimeout(() => getFCMToken(retries - 1), 1000); // Retry after 1 second
        } else {
            console.error("Failed to get the token:", error);
        }
    }
}

async function requestNotificationPermission() {
    Notification.requestPermission().then((permission) => {
        if (permission === "granted") {
            console.log("Notification permission granted.");
            getFCMToken();
        } else {
            console.log("Unable to get permission to notify.");
        }
    });
}

// Listen for foreground messages
onMessage(messaging, (payload) => {
    console.log("Message received in foreground: ", payload);
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };

    // Show the notification using the browser's Notification API
    new Notification(notificationTitle, notificationOptions);
});
