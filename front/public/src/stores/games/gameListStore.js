import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useGameListsStore = defineStore("gameList", {
  state: () => ({
    isLoading: false,
    isError: false,
    error: "",
    lists: [],
  }),
  actions: {
    error(message) {
      this.isError = true;
      this.error = message;
    },
    async getLists(userId, params = []) {
      this.isLoading = true;
      params = {
        ...params,
        user_id: userId,
      };
      return await fetchService("/api/game-list/lists-details", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
        params: params,
      })
        .then((response) => {
          this.lists = response.gamelist;
          return response;
        })
        .catch((error) => {
          this.error(error.message);
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
    async addGameToList(gameId, listId) {
      this.isLoading = true;
      return await fetchService("/api/game-list/add", {
        method: "POST",
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
