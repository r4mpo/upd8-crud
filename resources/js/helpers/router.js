import { createRouter, createWebHistory } from 'vue-router';

import Home from './../templates/Home.vue';
import Login from './../templates/Login.vue';
import Consulta from '../templates/Clientes/Consulta.vue';

const routes = [
    { 
        path: '/login', 
        component: Login 
    },
    {
        path: '/',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/clientes/consulta',
        component: Consulta,
        meta: { requiresAuth: true }
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Middleware de proteção de rotas
router.beforeEach((to, from, next) => {
    const estaLogado = !!sessionStorage.getItem('token');

    if (to.meta.requiresAuth && !estaLogado) {
        next('/login');
    } else {
        next();
    }
});

export default router;