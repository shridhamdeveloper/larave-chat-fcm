import { initializeApp } from "firebase/app";
import { getMessaging, onBackgroundMessage } from "firebase/messaging/sw";

// Initialize the Firebase app in the service worker by passing in
// your app's Firebase config object.
// https://firebase.google.com/docs/web/setup#config-object
const firebaseConfig = {
  apiKey: "AIzaSyA8a-DXtzqupLMU5UJuTuQ2N1PAy7PLGwA",
  authDomain: "chatsi-realtime-laravel-3ee6e.firebaseapp.com",
  projectId: "chatsi-realtime-laravel-3ee6e",
  storageBucket: "chatsi-realtime-laravel-3ee6e.appspot.com",
  messagingSenderId: "755761302018",
  appId: "1:755761302018:web:fd11c184a8a7819700751b"
};

// Retrieve an instance of Firebase Messaging so that it can handle background
// messages.
const firebase = initializeApp(firebaseConfig);
const messaging = getMessaging(firebase);

onBackgroundMessage(messaging, (payload) => {
  console.log('[firebase-messaging-sw.js] Received background message ', payload);
  // Customize notification here
  const {title, body} = paylod.notification;
  const notificationOptions = {
    body,
  };

  self.registration.showNotification(title,
    notificationOptions);
});