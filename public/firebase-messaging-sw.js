importScripts(
    "https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"
);
importScripts(
    "https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js"
);

// Initialize Firebase in the service worker
const firebaseConfig = {
    apiKey: "AIzaSyDKs9rp7sGQr8TP5yUEI1_YJ3llg8LPZ1k",
    authDomain: "nosaz-f1a86.firebaseapp.com",
    projectId: "nosaz-f1a86",
    storageBucket: "nosaz-f1a86.firebasestorage.app",
    messagingSenderId: "47873885304",
    appId: "1:47873885304:web:aceadfde9151848156998d",
    measurementId: "G-9XY26MSEC8",
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

// console.log("Messaging is initialized :", messaging);

messaging.onBackgroundMessage((payload) => {
    // console.log("Message received in background: ", payload);
    /**
     * If the notification is sent by Firebase panel, It has a notifcation object inside payload
     * and firebase package automatially creates and shows a notification. But if the notification
     * object is not present, it means the notificaiton is sent from custom panel or api so in this
     * case the title and body will be inside data object.
     */
    if (!payload.notification) {
        const notificationTitle = payload.data.title;
        const notificationOptions = {
            body: payload.data.body,
            icon: payload.data.icon ?? "/img/icon-512x512.png",
        };

        self.registration.showNotification(
            notificationTitle,
            notificationOptions
        );
    }
});
