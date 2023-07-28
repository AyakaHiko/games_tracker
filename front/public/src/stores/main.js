import { defineStore } from "pinia";
import axios from "axios";
import fetchService from "@/services/fetchService";

export const useMainStore = defineStore("main", {
  state: () => ({
    /**/
    user: {
      login: "",
      avatar: "",
      email: "",
    },
    isLogin: true,
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
      this.isLogin = false;
    },
    setUser() {
      try {
        return fetchService("/api/getUser/", {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          },
        }).then((response) => {
          console.log('resp')
          console.log(response);
          if (response === undefined) {
            console.log('under')
            this.isLogin = false;
            return null;
          }
          this.isLogin = true;
          return (this.user = {
            login: response.user.login,
            avatar: response.user.avatar,
            email: response.user.email,
          });
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
