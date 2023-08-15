import {createRouter, createWebHistory} from "vue-router";
import Home from "@/views/HomeView.vue";

const routes = [
  {
    meta: {
      title: "Select style",
    },
    path: "/",
    redirect: "/home",
  },
  {
    // Document title tag
    // We combine it with defaultDocumentTitle set in `src/main.js` on router.afterEach hook
    meta: {
      title: "Home",
    },
    path: "/home",
    name: "home",
    component: Home,
  },
  {
    meta: {
      title: "Profile",
    },
    path: "/profile",
    name: "profile",
    component: () => import("@/views/ProfileView.vue"),
  },
  {
    meta: {
      title: "Login",
    },
    path: "/login",
    name: "login",
    component: () => import("@/views/Authorization/LoginView.vue"),
  },

  {
    meta: {
      title: "Registration",
    },
    path: "/registration",
    name: "registration",
    component: () => import("@/views/Authorization/RegistrationView.vue"),
  },
  {
    meta: {
      title: "Error",
    },
    path: "/error",
    name: "error",
    component: () => import("@/views/ErrorView.vue"),
  },
  {
    meta: {
      title: "Game Library",
    },
    path: "/games",
    name: "games",
    component: () => import("@/views/Games/LibraryView.vue"),
  },

  {
    meta: {
      title: "Game Lists",
    },
    path: "/game-lists/:userId",
    name: "gamelists",
    props: true,
    component: () => import("@/views/Profile/GameLists.vue"),
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
  scrollBehavior(to, from, savedPosition) {
    return savedPosition || { top: 0 };
  },
});

export default router;
