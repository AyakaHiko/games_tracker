import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";
const gamesPath = "games";

export const useGamesStore = defineStore("games", {
  state: () => ({
    games: JSON.parse(localStorage.getItem(gamesPath)) || {},
    isLoading: false,
    pageCount: 851462,
    pageSize: 10,
  }),
  actions: {
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
          this.games = response.results;
          this.pageCount = response.count;
          localStorage.setItem(gamesPath, JSON.stringify(this.games));
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
