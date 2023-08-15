import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useMainStore = defineStore("main", {
  state: () => ({
    /**/
    isLoading: false,
    user: {
      id: "",
      login: "",
      avatar: "",
      email: "",
      verified: null,
      wishlistId: null,
      completedListId: null,
      uncompletedListId: null,
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
    async getUserLists() {
      await fetchService("/api/game-list/lists", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
        params: {
          user_id: this.user.id,
        },
      })
        .then((response) => {
          response.gamelist.forEach((list) => {
            switch (list.list_type?.name) {
              case "Wishlist":
                this.user.wishlistId = list.id;
                break;
              case "Completed":
                this.user.completedListId = list.id;
                break;
              case "Uncompleted":
                this.user.uncompletedListId = list.id;
                break;
            }
          });
        })
        .catch((error) => {
          console.error(error);
        });
    },
    async setUser(user) {
      this.user.id = user.id;
      this.user.login = user.login;
      this.user.avatar = user.avatar;
      this.user.email = user.email;
      this.user.verified = user.verified;
      await this.getUserLists();
      this.isLogin = true;
    },
    getUser() {
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
