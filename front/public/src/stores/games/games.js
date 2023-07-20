import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useGamesStore = defineStore("games", {
  state: () => ({
    games: [],
  }),
  actions:{
    async getAllGames() {
      this.isLoading = true;
      await fetchService("/api/games/", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        }
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
    }
  }
});
