import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

class Firebase {
    constructor() {
        this.messaging = null;
        this.initializeFirebase();
    }

    initializeFirebase() {
        const firebaseConfig = {
            apiKey: "AIzaSyDKs9rp7sGQr8TP5yUEI1_YJ3llg8LPZ1k",
            authDomain: "nosaz-f1a86.firebaseapp.com",
            projectId: "nosaz-f1a86",
            storageBucket: "nosaz-f1a86.firebasestorage.app",
            messagingSenderId: "47873885304",
            appId: "1:47873885304:web:3a511741e8f1713056998d",
            measurementId: "G-N8FX7TEKXL",
        };

        //   const firebaseConfig = {
        //     apiKey: "AIzaSyDKs9rp7sGQr8TP5yUEI1_YJ3llg8LPZ1k",
        //     authDomain: "nosaz-f1a86.firebaseapp.com",
        //     projectId: "nosaz-f1a86",
        //     storageBucket: "nosaz-f1a86.firebasestorage.app",
        //     messagingSenderId: "47873885304",
        //     appId: "1:47873885304:web:aceadfde9151848156998d",
        //     measurementId: "G-9XY26MSEC8"
        //   };

        const app = initializeApp(firebaseConfig);
        this.messaging = getMessaging(app);
    }

    async register() {
        try {
            await this.registerServiceWorker();
            await this.getFCMToken();
            this.listenForMessages();
        } catch (error) {
            console.error("Failed to initialize Firebase:", error);
        }
    }

    async registerServiceWorker() {
        try {
            const registration = await navigator.serviceWorker.register(
                "/firebase-messaging-sw.js",
                { scope: "fcm" }
            );
            console.log(
                "Service Worker registered with scope:",
                registration.scope
            );

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
        } catch (error) {
            console.error("Service Worker registration failed:", error);
        }
    }

    async getFCMToken(retries = 3) {
        console.log("Getting FCM token...");
        try {
            const token = await getToken(this.messaging, {
                vapidKey:
                    "BJWatfCQoF9P7ittgUnbxTa2wzRoql53KijkeMXTTBZAARraG0vo-NXLALoUmoNjK7_0yNggI2oWHdX_Lw11pGA",
            });

            if (token) {
                console.log("FCM Token:", token);
                // Optionally send this token to your server for future use
            } else {
                console.log(
                    "No registration token available. Requesting permission."
                );
                await this.requestNotificationPermission();
            }
        } catch (error) {
            if (retries > 0 && error.name === "AbortError") {
                console.log("Retrying token retrieval...");
                setTimeout(() => this.getFCMToken(retries - 1), 1000);
            } else {
                console.error("Failed to get FCM token:", error);
            }
        }
    }

    async requestNotificationPermission() {
        const permission = await Notification.requestPermission();
        if (permission === "granted") {
            console.log("Notification permission granted.");
            await this.getFCMToken();
        } else {
            console.log("Unable to get permission to notify.");
        }
    }

    listenForMessages() {
        onMessage(this.messaging, (payload) => {
            console.log("Message received in foreground:", payload);
            const { title, body, icon } = payload.notification;
            new Notification(title, { body, icon });
        });
    }
}

export default Firebase;
