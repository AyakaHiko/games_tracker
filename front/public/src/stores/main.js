import { defineStore } from "pinia";
import axios from "axios";
import fetchService from "@/services/fetchService";

export const useMainStore = defineStore("main", {
  state: () => ({
    /* User */
    userName: null,
    userEmail: null,
    userAvatar: null,

    /**/
    user: null,

    /* Field focus with ctrl+k (to register only once) */
    isFieldFocusRegistered: false,

    /* Sample data (commonly used) */
    clients: [],
    history: [],
  }),
  actions: {
    async logout() {
      await fetchService("/api/logout/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
      });
    },
    setDefUser(payload) {
      if (payload.name) {
        this.userName = payload.name;
      }
      if (payload.email) {
        this.userEmail = payload.email;
      }
      if (payload.avatar) {
        this.userAvatar = payload.avatar;
      }
    },
    setUser() {
      try {
        fetchService("/api/getUser/", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }).then((response) => {
          console.log(response);
          this.user = {
            login: response.user.login,
            avatar: response.user.avatar,
            email: response.user.email,
          };
        });
      } catch (e) {
        console.log(e.message);
      }
    },

    fetch(sampleDataKey) {
      axios
        .get(`data-sources/${sampleDataKey}.json`)
        .then((r) => {
          if (r.data && r.data.data) {
            this[sampleDataKey] = r.data.data;
          }
        })
        .catch((error) => {
          alert(error.message);
        });
    },
  },
});
