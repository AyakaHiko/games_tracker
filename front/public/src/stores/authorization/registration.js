import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useRegistrationStore = defineStore("registration", {
  state: () => ({
    isPreload: false,
    isError: false,
    error: {},
  }),
  actions: {
    async doRegister(newUser) {
      this.isPreload = true;
      await fetchService("/api/register/", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(newUser),
      })
        .then((response) => {
          return response;
        })
        .catch((error) => {
          this.isError = true;
          this.error = error;
        })
        .finally(() => {
          this.isPreload = false;
        });
    },
  },
});
