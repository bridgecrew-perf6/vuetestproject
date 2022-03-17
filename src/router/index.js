import Vue from "vue";
import VueRouter from "vue-router";
import menupage from "../components/menupage.vue";
import Addmenu from "../components/Addmenu.vue";
import finance from "../components/finance.vue";
import dashboard from "../components/dashboard.vue";
import Queue from "../components/Queue.vue";
import RawMaterial from "../components/RawMaterial.vue";
import Noodle from "../components/Noodle.vue";
import test from "../components/test.vue";
import tables from "../components/tables.vue";
import Login from "../components/Login.vue";
import Register from "../components/Register.vue";
import firebase from "firebase/compat/app";
import App1 from "../App1.vue";
import navbar from "../components/navbar.vue";

Vue.use(VueRouter);

const routes = [
  {
    path: "/menupage",
    name: "menupage",
    component: menupage,
  },
  {
    path: "/",
    name: "Login",
    component: Login,
  },
  {
    path: "/Addmenu",
    name: "Addmenu",
    component: Addmenu,
  },
  {
    path: "/finance",
    name: "finance",
    component: finance,
  },
  {
    path: "/dashboard",
    name: "dashboard",
    component: dashboard,
  },
  {
    path: "/Queue",
    name: "Queue",
    component: Queue,
  },
  {
    path: "/RawMaterial",
    name: "RawMaterial",
    component: RawMaterial,
  },
  {
    path: "/Noodle",
    name: "Noodle",
    component: Noodle,
  },
  {
    path: "/test",
    name: "test",
    component: test,
  },
  {
    path: "/tables",
    name: "tables",
    component: tables,
  },
  {
    path: "/Register",
    name: "Register",
    component: Register,
  },
  // {
  //   path: "/Login",
  //   name: "Login",
  //   component: Login,
  // },
  {
    path: "/App1",
    name: "App1",
    component: App1,
  },
  {
    path: "/navbar",
    name: "navbar",
    component: navbar,
  },
];

const router = new VueRouter({
  mode: "history",
  base: process.env.BASE_URL,
  routes,
});

router.beforeEach((to, form, next) => {
  const requiresAuth = to.matched.some((record) => record.meta.requiresAuth);
  const isAuthenticated = firebase.auth().currentUser;
  if (requiresAuth && !isAuthenticated) {
    next("/Login");
  } else {
    next();
  }
});

export default router;
