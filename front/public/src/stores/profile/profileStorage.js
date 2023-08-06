import { defineStore } from "pinia";
import fetchService from "@/services/fetchService";
import { useMainStore } from "@/stores/main";

export const useProfileStore = defineStore("profile", {
  state: () => ({
    isLoading: false,
    isError: false,
    error: "",
    isLogin: localStorage.getItem("isLogin") || null,
  }),
  actions: {
    logError(message) {
      this.isError = true;
      this.error = message;
    },
    updateAvatar(formData) {
      this.isLoading = true;
      fetchService("/api/updateAvatar", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (response !== undefined)
            useMainStore().user.avatar = response.avatarPath;
        })
        .finally(() => {
          this.isLoading = false;
        });
    },
  },
});
