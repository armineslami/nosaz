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

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
