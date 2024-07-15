import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: "/media",
        name: "MediaManager",
        component: () => import("./components/MediaManager.vue"),
    },
    {
        path: "/media/upload",
        name: "MediaUpload",
        component: () => import("./components/MediaUpload.vue"),
    },
    {
        path: "/:pathMatch(.*)*",
        // redirect: { name: "MediaManager" },
        name: "NotFound",
        component: () => import("./components/NotFound.vue"),
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;