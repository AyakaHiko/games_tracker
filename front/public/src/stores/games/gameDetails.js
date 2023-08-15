import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useGameDetailsStore = defineStore("gameDetails", {
  state: () => ({
    detailedGame: {},
    error: "",
    isError: false,
    isLoading: false,
  }),
  actions: {
    error(message) {
      this.isError = true;
      this.error = message;
    },
    async getGame(id) {
      this.isLoading = true;
      return await fetchService("/api/games/" + id, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          this.detailedGame = response.original;
          return this.detailedGame;
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
