import fetchService from "@/services/fetchService";
import { defineStore } from "pinia";
import {useMainStore} from "@/stores/main";

export const useAuthorizationStore = defineStore("authorization", {
  state: () => ({
    isLoading: false,
    isError: false,
    error: "",
    isLogin: localStorage.getItem("isLogin") || null,
  }),
  actions: {
    logError(message) {
      this.isError = true;
      this.error = message;
    },
    login(response) {
      localStorage.setItem("isLogin", true);
      useMainStore().setUser(response.user);
      localStorage.setItem("token", response.authorization.token);
      this.isLogin = true;
    },
    async doLogin(userData) {
      this.isLoading = true;
      await fetchService("/api/login/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(userData),
      })
        .then((response) => {
          console.log(response);
          this.login(response);
          if (response.status === 401) {
            this.logError("Unauthorized");
          }
          return response;
        })
        .catch(() => {
          this.logError("Authorization failed");
        })
        .finally(() => (this.isLoading = false));
    },
    logout() {
      this.isLoading = true;
      this.isLogin = false;
      localStorage.setItem("isLogin", false);
      localStorage.removeItem("token");
      this.isLoading = false;
    },
  },
});
