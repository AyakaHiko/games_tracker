<script setup>
import { onMounted } from "vue";
import BaseIcon from "@/components/Elements/BaseIcon.vue";
import {
  mdiCheckCircleOutline,
  mdiHeartPlusOutline,
  mdiPlaylistPlus,
} from "@mdi/js/commonjs/mdi";

defineProps({
  item: {
    type: Object,
    required: true,
  },
});

onMounted(() => {
  console.log("item");
});
</script>

<template>
  <li>
    <div class="container">
      <div class="card-group vgr-cards">
        <div class="card">
          <div class="card-img-body">
            <img
              class="card-img"
              :src="item.background_image"
              alt="{{item.slug}}"
            />
          </div>
          <div class="card-body">
            <h4 class="card-title">{{ item.name }}</h4>
            <p class="card-text"></p>
<!--            <a href="#" class="btn btn-outline-primary">-->
<!--              <BaseIcon-->
<!--                :path="mdiPlaylistPlus"-->
<!--                class="flex-none"-->
<!--                w="w-16"-->
<!--                :size="18"-->
<!--              />-->
<!--            </a>-->
<!--            <a href="#" class="btn btn-outline-primary">-->
<!--              <BaseIcon-->
<!--                :path="mdiHeartPlusOutline"-->
<!--                class="flex-none"-->
<!--                w="w-16"-->
<!--                :size="18"-->
<!--              />-->
<!--            </a>-->
<!--            <a href="#" class="btn btn-outline-primary">-->
<!--              <BaseIcon-->
<!--                :path="mdiCheckCircleOutline"-->
<!--                class="flex-none"-->
<!--                w="w-16"-->
<!--                :size="18"-->
<!--              />-->
<!--            </a>-->
          </div>
        </div>
      </div>
    </div>
  </li>
</template>

<style scoped>
body {
  margin-top: 20px;
}

.card {
  border: none;
}
.card-img {
  border-radius: 0;
}

.vgr-cards {
  .card {
    display: flex;
    flex-flow: wrap;
    flex: 100%;
    margin-bottom: 40px;

    &:nth-child(even) .card-img-body {
      order: 2;
    }

    &:nth-child(even) .card-body {
      padding-left: 0;
      padding-right: 1.25rem;
    }

    @media (max-width: 576px) {
      display: block;
    }
  }

  .card-img-body {
    flex: 1;
    overflow: hidden;
    position: relative;

    @media (max-width: 576px) {
      width: 100%;
      height: 200px;
      margin-bottom: 20px;
    }
  }

  .card-img {
    width: 100%;
    height: auto;
    position: absolute;
    margin-left: 50%;
    transform: translateX(-50%);

    @media (max-width: 1140px) {
      margin: 0;
      transform: none;
      width: 100%;
      height: auto;
    }
  }

  .card-body {
    flex: 2;
    padding: 0 0 0 1.25rem;

    @media (max-width: 576px) {
      padding: 0;
    }
  }
}
</style>
