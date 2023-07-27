<script setup>
import { ref, onMounted } from "vue";
import { useMainStore } from "@/stores/main";
import * as chartConfig from "@/components/Charts/chart.config.js";
import SectionMain from "@/components/Elements/SectionMain.vue";
import LayoutMain from "@/layouts/LayoutMain.vue";

const chartData = ref(null);

const fillChartData = () => {
  chartData.value = chartConfig.sampleChartData();
};

onMounted(() => {
  fillChartData();
});

const mainStore = useMainStore();
</script>

<template>
  <LayoutMain>
    <SectionMain> This is home page! </SectionMain>
  </LayoutMain>
</template>
