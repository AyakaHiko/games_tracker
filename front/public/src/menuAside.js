import {
  mdiAccountCircle,
  mdiMonitor,
  mdiController,
} from "@mdi/js";

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
    label: "Games",
    icon: mdiController,
    menu: [
      {
        label: "Item One",
      },
      {
        label: "Item Two",
      },
    ],
  },
];
