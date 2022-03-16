import Vue from 'vue'
import App from './App.vue'
import router from './router'
import vuetify from './plugins/vuetify'
import store from './store'
import axios from 'axios'
import firebase from 'firebase/compat/app'
import 'material-design-icons-iconfont/dist/material-design-icons.css'
import  'boxicons/css/boxicons.min.css'



Vue.prototype.axios = axios
Vue.config.productionTip = false

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyD96JjVaZm7bCu_zzstWy8T3Xi2Mto_Y3I",
  authDomain: "teowteow-abc30.firebaseapp.com",
  projectId: "teowteow-abc30",
  storageBucket: "teowteow-abc30.appspot.com",
  messagingSenderId: "579619266730",
  appId: "1:579619266730:web:c8d80786591555880db0d3",
  measurementId: "G-YB2Y4W52GN"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

let app;
firebase.auth().onAuthStateChanged(user => {
  console.log(user);
  if (!app) {
    app = new Vue({
      router,
      store,
      vuetify,
      render: h => h(App)
    }).$mount('#app')
  }
})
