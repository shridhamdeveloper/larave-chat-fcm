importScripts('https://www.gstatic.com/firebasejs/8.0/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.0/firebase-messaging.js');
// // https://firebase.google.com/docs/web/setup#config-object
const firebaseConfig = {
  apiKey: "AIzaSyA8a-DXtzqupLMU5UJuTuQ2N1PAy7PLGwA",
  authDomain: "chatsi-realtime-laravel-3ee6e.firebaseapp.com",
  projectId: "chatsi-realtime-laravel-3ee6e",
  storageBucket: "chatsi-realtime-laravel-3ee6e.appspot.com",
  messagingSenderId: "755761302018",
  appId: "1:755761302018:web:fd11c184a8a7819700751b"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
    // Customize notification here
    const {title, body} = payload.notification;
    const notificationOptions = {
        body,
    };

    return self.registration.showNotification(title,
        notificationOptions);
});