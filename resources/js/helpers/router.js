import { createRouter, createWebHistory } from 'vue-router';

import Home from './../templates/Home.vue';
import Login from './../templates/Login.vue';
import ConsultaClientes from '../templates/Clientes/ConsultaClientes.vue';
import ConsultaRepresentantes from '../templates/Representantes/ConsultaRepresentantes.vue';

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
        component: ConsultaClientes,
        meta: { requiresAuth: true }
    },
    {
        path: '/representantes/consulta',
        component: ConsultaRepresentantes,
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