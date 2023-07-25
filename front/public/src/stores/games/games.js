import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";
const gamesPath = "games";

export const useGamesStore = defineStore("games", {
  state: () => ({
    games: JSON.parse(localStorage.getItem(gamesPath)) || {},
    isLoading: false,
    pageSize: 10,
  }),
  actions: {
    error(message) {
      this.isError = true;
      this.error = message;
    },
    async getPageCount() {
      await fetchService("/api/games/", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      })
        .then((response) => {
          console.log(response);
          return response.result.lastPage;
        })
        .catch((error) => {
          this.error(error.message);
          return null;
        });
    },
    async getGames(page = 1) {
      this.isLoading = true;
      await fetchService("/api/games/", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
        params: {
          page_size: this.pageSize,
          page: page,
        },
      })
        .then((response) => {
          this.games = response.result.data;
          return this.games;
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
