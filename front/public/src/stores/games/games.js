import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";

export const useGamesStore = defineStore("games", {
  state: () => ({
    games: [],
    cachedData: {},
    isLoading: false,
    pageSize: 10,
    search:""
  }),
  actions: {
    error(message) {
      this.isError = true;
      this.error = message;
    },

    async getData(page = 1) {
      this.isLoading = true;
      if (this.cachedData[page]) {
        this.games = this.cachedData[page];
        this.isLoading = false;
        return;
      }
      return await fetchService("/api/games/", {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
        params: {
          page_size: this.pageSize,
          page: page,
          search: this.search,
        },
      })
        .then((response) => {
          this.games = response.result.data;
          this.cachedData[page] = response.result.data;
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
