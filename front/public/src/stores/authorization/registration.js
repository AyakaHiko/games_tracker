import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useRegistrationStore = defineStore("registration", {
  state: () => ({
    isLoading: false,
    isError: false,
    error: "",
  }),
  actions: {

    error(message) {
      this.isError = true;
      this.error = message;
    },
    async doRegister(newUser) {
      this.isLoading = true;
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
          this.error(error.message);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
});
