import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useGamesStore = defineStore("gameList", {
  state: () => ({
    isLoading: false,
  }),
  actions: {
    error(message) {
      this.isError = true;
      this.error = message;
    },

    async addGameToList(gameId, listId) {
      this.isLoading = true;
      return await fetchService("/api/games/", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
        params: {
          game_id: gameId,
          list_id: listId,
        },
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
