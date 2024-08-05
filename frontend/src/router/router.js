import Notes from "@/pages/Notes.vue";
import {createRouter, createWebHistory} from "vue-router";


const routes = [
    {
        path: '/',
        component: Notes
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

export default router;