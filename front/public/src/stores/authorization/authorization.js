import fetchService from "@/services/fetchService";
import { defineStore } from "pinia";

export const useAuthorizationStore = defineStore("authorization", {
  state: () => ({
    isPreload: false,
    isError: false,
    error: {},
    isLogin: localStorage.getItem("isLogin") || null,
  }),
  actions: {
    login(response) {
      localStorage.setItem("isLogin", true);
      console.log('login')
      console.log(response);
      this.isLogin = true;
    },
    async doLogin(userData) {
      this.isPreload = true;
      await fetchService("/api/login/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(userData),
      })
        .then((response) => {
          this.login(response);
        })
        .catch((error) => {
          this.isError = true;
          this.error = error;
        })
        .finally(() => {
          this.isPreload = false;
        });
    },
    logout() {
      this.isPreload = true;
      this.isLogin = false;
      localStorage.setItem("isLogin", false);
      localStorage.removeItem("token");
      this.isPreload = false;
    },
  },
});
