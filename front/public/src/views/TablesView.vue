<script setup>
import {
  mdiMonitorCellphone,
  mdiTableBorder,
  mdiTableOff,
  mdiGithub,
} from "@mdi/js";
import SectionMain from "@/components/Elements/SectionMain.vue";
import NotificationBar from "@/components/Elements/NotificationBar/NotificationBar.vue";
import TableSampleClients from "@/components/Elements/TableSampleClients.vue";
import CardBox from "@/components/Elements/CardBox/CardBox.vue";
import LayoutMain from "@/layouts/LayoutMain.vue";
import SectionTitleLineWithButton from "@/components/Elements/SectionTitleLineWithButton.vue";
import BaseButton from "@/components/Elements/BaseButton.vue";
import CardBoxComponentEmpty from "@/components/Elements/CardBox/CardBoxComponentEmpty.vue";
</script>

<template>
  <LayoutMain>
    <SectionMain>
      <SectionTitleLineWithButton :icon="mdiTableBorder" title="Tables" main>
        <BaseButton
          href="https://github.com/justboil/admin-one-vue-tailwind"
          target="_blank"
          :icon="mdiGithub"
          label="Star on GitHub"
          color="contrast"
          rounded-full
          small
        />
      </SectionTitleLineWithButton>
      <NotificationBar color="info" :icon="mdiMonitorCellphone">
        <b>Responsive table.</b> Collapses on mobile
      </NotificationBar>

      <CardBox class="mb-6" has-table>
        <TableSampleClients checkable />
      </CardBox>

      <SectionTitleLineWithButton :icon="mdiTableOff" title="Empty variation" />

      <NotificationBar color="danger" :icon="mdiTableOff">
        <b>Empty table.</b> When there's nothing to show
      </NotificationBar>

      <CardBox>
        <CardBoxComponentEmpty />
      </CardBox>
    </SectionMain>
  </LayoutMain>
</template>
