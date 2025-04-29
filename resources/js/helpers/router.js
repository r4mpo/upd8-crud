import { createRouter, createWebHistory } from 'vue-router';

import Home from './../templates/Home.vue';
import Login from './../templates/Login.vue';
import ConsultaClientes from '../templates/Clientes/ConsultaClientes.vue';
import ConsultaRepresentantes from '../templates/Representantes/ConsultaRepresentantes.vue';
import ConsultaCidades from '../templates/Cidades/ConsultaCidades.vue';

const routes = [
    { 
        path: '/login', 
        name: 'login',
        component: Login 
    },
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: { requiresAuth: true }
    },
    {
        path: '/clientes/consulta',
        name: 'consultar_clientes',
        component: ConsultaClientes,
        meta: { requiresAuth: true }
    },
    {
        path: '/representantes/consulta',
        name: 'consultar_representantes',
        component: ConsultaRepresentantes,
        meta: { requiresAuth: true }
    },
    {
        path: '/cidades/consulta',
        name: 'consultar_cidades',
        component: ConsultaCidades,
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