import { createRouter, createWebHistory } from 'vue-router';

import Home from './../templates/Home.vue';
import Login from './../templates/Login.vue';
import ConsultaClientes from '../templates/Clientes/ConsultaClientes.vue';
import AnalisaClientes from '../templates/Clientes/AnalisaClientes.vue';
import ConsultaRepresentantes from '../templates/Representantes/ConsultaRepresentantes.vue';
import AnalisaRepresentantes from '../templates/Representantes/AnalisaRepresentantes.vue';
import ConsultaCidades from '../templates/Cidades/ConsultaCidades.vue';
import AnalisaCidades from '../templates/Cidades/AnalisaCidades.vue';
import ConsultaRepresentantesPorCidade from '../templates/Relatorios/ConsultaRepresentantesPorCidade.vue';
import ConsultaRepresentantesPorCliente from '../templates/Relatorios/ConsultaRepresentantesPorCliente.vue';

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
        path: '/clientes/analisa/:id?',
        name: 'analisar_clientes',
        component: AnalisaClientes,
        meta: { requiresAuth: true }
    },
    {
        path: '/representantes/consulta',
        name: 'consultar_representantes',
        component: ConsultaRepresentantes,
        meta: { requiresAuth: true }
    },
    {
        path: '/representantes/analisa/:id?',
        name: 'analisar_representantes',
        component: AnalisaRepresentantes,
        meta: { requiresAuth: true }
    },
    {
        path: '/cidades/consulta',
        name: 'consultar_cidades',
        component: ConsultaCidades,
        meta: { requiresAuth: true }
    },
    {
        path: '/cidades/analisa/:id?',
        name: 'analisar_cidades',
        component: AnalisaCidades,
        meta: { requiresAuth: true }
    },
    {
        path: '/relatorios/representantes_cidades',
        name: 'representantes_cidades',
        component: ConsultaRepresentantesPorCidade,
        meta: { requiresAuth: true }
    },
    {
        path: '/relatorios/representantes_clientes',
        name: 'representantes_clientes',
        component: ConsultaRepresentantesPorCliente,
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