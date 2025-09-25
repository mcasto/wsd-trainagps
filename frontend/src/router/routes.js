import callApi from "src/assets/call-api";
import { useStore } from "src/stores/store";

const routes = [
  {
    path: "/",
    component: () => import("layouts/MainLayout.vue"),
    children: [
      {
        path: "",
        component: () => import("pages/IndexPage.vue"),
        beforeEnter: () => {
          callApi({ path: "/registered", method: "get" }).then((response) => {
            const store = useStore();
            store.registrations = response.registrations;
          });
        },
      },
    ],
  },

  {
    path: "/registered",
    component: () => import("pages/RegisteredPage.vue"),
    beforeEnter: async (to, from, next) => {
      const store = useStore();
      if (!store.token) {
        next("/login");
        return;
      }

      const response = await callApi({
        path: "/verify-token",
        method: "get",
        useAuth: true,
      }).catch(() => {
        next("/login");
        return;
      });

      callApi({ path: "/registered", method: "get", useAuth: true }).then(
        (response) => {
          const store = useStore();
          store.registrations = response.registrations;
        }
      );

      next();
    },
  },

  {
    path: "/login",
    component: () => import("pages/LoginPage.vue"),
  },

  // Always leave this as last one,
  // but you can also remove it
  {
    path: "/:catchAll(.*)*",
    component: () => import("pages/ErrorNotFound.vue"),
  },
];

export default routes;
