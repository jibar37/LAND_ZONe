// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyBiXp6lIvoLtshltGf2NIfDLzALbLvMbiQ",
    authDomain: "land-zone.firebaseapp.com",
    projectId: "land-zone",
    storageBucket: "land-zone.appspot.com",
    messagingSenderId: "253854449987",
    appId: "1:253854449987:web:6cba20f691950753f4aff6",
    measurementId: "G-L5WZTZF7E0"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);