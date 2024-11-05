import { initializeApp } from "firebase/app";
import { getMessaging, getToken, onMessage } from "firebase/messaging";

class Firebase {
    DEBUG = true;

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
            appId: "1:47873885304:web:aceadfde9151848156998d",
            measurementId: "G-9XY26MSEC8",
        };

        const app = initializeApp(firebaseConfig);
        this.messaging = getMessaging(app);
    }

    async init() {
        try {
            const permission = Notification.permission;

            if (permission === "granted") {
                this.runIfDebug(
                    this.DEBUG,
                    console.log,
                    "Notifications permission in granted."
                );
                await this.registerServiceWorker();
                await this.getFCMToken();
                this.listenForMessages();
            } else if (permission === "denied") {
                this.runIfDebug(
                    this.DEBUG,
                    console.log,
                    "Notifications are disabled by the user."
                );
            } else if (permission === "default") {
                this.runIfDebug(
                    this.DEBUG,
                    console.log,
                    "Notification permission has not been requested yet."
                );
                await this.requestNotificationPermission();
                this.register();
            }
        } catch (error) {
            this.runIfDebug(
                this.DEBUG,
                console.log,
                "Failed to initialize Firebase:",
                error
            );
        }
    }

    async registerServiceWorker() {
        try {
            const registration = await navigator.serviceWorker.register(
                "/firebase-messaging-sw.js",
                { scope: "fcm" }
            );
            this.runIfDebug(
                this.DEBUG,
                console.log,
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
                this.runIfDebug(
                    this.DEBUG,
                    console.log,
                    "Service Worker is now controlling the page."
                );
            }
        } catch (error) {
            this.runIfDebug(
                this.DEBUG,
                console.log,
                "Service Worker registration failed:",
                error
            );
        }
    }

    async getFCMToken(retries = 3) {
        this.runIfDebug(this.DEBUG, console.log, "Getting FCM token...");
        try {
            const token = await getToken(this.messaging, {
                vapidKey:
                    "BJWatfCQoF9P7ittgUnbxTa2wzRoql53KijkeMXTTBZAARraG0vo-NXLALoUmoNjK7_0yNggI2oWHdX_Lw11pGA",
            });

            if (token) {
                this.runIfDebug(this.DEBUG, console.log, "FCM Token:", token);
                // Store the token
            }
        } catch (error) {
            if (retries > 0 && error.name === "AbortError") {
                this.runIfDebug(
                    this.DEBUG,
                    console.log,
                    "Retrying token retrieval..."
                );
                setTimeout(() => this.getFCMToken(retries - 1), 1000);
            } else {
                this.runIfDebug(
                    this.DEBUG,
                    console.log,
                    "Failed to get FCM token:",
                    error
                );
            }
        }
    }

    async requestNotificationPermission() {
        return await Notification.requestPermission();
    }

    listenForMessages() {
        onMessage(this.messaging, (payload) => {
            runIfDebug(
                DEBUG,
                console.log,
                "Message received in foreground:",
                payload
            );
            const { title, body, icon } = payload.notification;
            new Notification(title, { body, icon });
        });
    }

    runIfDebug(debug, func, ...args) {
        if (debug) {
            func(...args);
        }
    }
}

export default Firebase;
