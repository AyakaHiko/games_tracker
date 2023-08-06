import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useMainStore = defineStore("main", {
  state: () => ({
    /**/
    isLoading: false,
    user: {
      login: "",
      avatar: "",
      email: "",
    },
    isLogin: false,
    /* Field focus with ctrl+k (to register only once) */
    isFieldFocusRegistered: false,
  }),
  actions: {
    async logout() {
      await fetchService("/api/logout/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
      });
      this.isLogin = false;
    },
    setUser(user) {
      this.user = {
        login: user.login,
        avatar: user.avatar,
        email: user.email,
      };
      this.isLogin = true;
    },
    getUser() {
      console.log("start getting user");
      this.isLoading = true;
      try {
        fetchService("/api/getUser/", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }).then((response) => {
          if (response === undefined) {
            this.isLogin = false;
          } else {
            this.setUser(response.user);
          }
          this.isLoading = false;
        });
      } catch (e) {
        console.log(e.message);
      }
    },
  },
});
