import { mdiAccountCircle, mdiMonitor, mdiController } from "@mdi/js";

export default [
  {
    to: "/home",
    icon: mdiMonitor,
    label: "Home",
  },
  {
    to: "/profile",
    label: "Profile",
    icon: mdiAccountCircle,
  },
  {
    to: "/games",
    label: "Game Library",
    icon: mdiController,
  },
];
