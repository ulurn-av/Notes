import Notes from "@/pages/Notes.vue";
import {createRouter, createWebHistory} from "vue-router";
import LoginPage from "@/pages/LoginPage.vue";
import SignupPage from "@/pages/SignupPage.vue";


const routes = [
    {
        path: '/',
        component: Notes
    },
    {
        path: '/login',
        component: LoginPage
    },
    {
        path: '/signup',
        component: SignupPage
    },
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

export default router;