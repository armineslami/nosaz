// document.addEventListener("DOMContentLoaded", () => {
//     // Get registration token. Initially this makes a network call, once retrieved
//     // subsequent calls to getToken will return from cache.
//     const messaging = window.getMessaging();
//     window
//         .getToken(messaging, {
//             vapidKey:
//                 "BK86acGo2FOs2DBFwH4dC8YDg3TT0XbnLty0_alSPjcrUk0AjjRZGTomqbsoVEdMbB6Mlyy0QE6fsltBUdGuuQM",
//         })
//         .then((currentToken) => {
//             if (currentToken) {
//                 // Send the token to your server and update the UI if necessary
//                 // ...
//             } else {
//                 // Show permission request UI
//                 console.log(
//                     "No registration token available. Request permission to generate one."
//                 );
//                 // ...
//             }
//         })
//         .catch((err) => {
//             console.log("An error occurred while retrieving token. ", err);
//             // ...
//         });
// });
// public/firebase-messaging-sw.js

importScripts(
    "https://www.gstatic.com/firebasejs/9.0.0/firebase-app-compat.js"
);
importScripts(
    "https://www.gstatic.com/firebasejs/9.0.0/firebase-messaging-compat.js"
);

// Initialize Firebase in the service worker
const firebaseConfig = {
    apiKey: "AIzaSyByJLWSl0XUpzRZHPQRf9x2fJmO6TXsvWM",
    authDomain: "nosaz-8e631.firebaseapp.com",
    projectId: "nosaz-8e631",
    storageBucket: "nosaz-8e631.firebasestorage.app",
    messagingSenderId: "759253213886",
    appId: "1:759253213886:web:c5395d715677944b9274ef",
    measurementId: "G-EMYZQPB5F9",
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

console.log("Messaging is initialized :", messaging);

messaging.onBackgroundMessage((payload) => {
    console.log("Message received in background: ", payload);

    const notificationTitle = payload.notification.title;
    const notificationOptions = {
        body: payload.notification.body,
        icon: payload.notification.icon,
    };

    self.registration.showNotification(notificationTitle, notificationOptions);
});
