import Notes from "@/pages/Notes.vue";
import {createRouter, createWebHistory} from "vue-router";
import LoginPage from "@/pages/LoginPage.vue";
import SignupPage from "@/pages/SignupPage.vue";
import axios from "axios";
import NotFound from "@/pages/NotFound.vue";
import { BASE_URL } from '@/config.js';


const routes = [
    {
        path: '/',
        component: Notes,
        meta: {
            requiresAuth: true
        },
    },
    {
        path: '/login',
        component: LoginPage
    },
    {
        path: '/signup',
        component: SignupPage
    },
    {
        path: '/:pathMatch(.*)*',
        component: NotFound
    }
]

const router = createRouter({
    routes,
    history: createWebHistory(),
})

async function isAuthenticated(){
    const token = localStorage.getItem('token');
    if (!token)
        return false;

    try{
        const response = await axios.post(`${BASE_URL}/v1/auth/validate-token`, {}, {
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `Bearer ${token}`
            }
        });
        return response.data.validated;
    } catch (error){
        console.error('Error validating token:', error);
        return false;
    }
}

router.beforeEach(async (to, from, next) => {
    const isAuth = await isAuthenticated();
    if (to.meta.requiresAuth && !isAuth) {
        next({ path: '/login' });
    }
    else if ((to.path === '/login' || to.path === '/signup') && isAuth){
        next({ path: '/' });
    }
    else if (to.path === '/' && !isAuth){
        next({ path: '/login' });
    }
    else{
        next();
    }
})

export default router