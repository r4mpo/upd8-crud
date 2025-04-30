<template>
    <div class="container-custom">
        <Navbar />

        <SearchForm
            :filtros="filtros"
            :clientes="clientes"
            @pesquisar-representantes-clientes="pesquisarRepresentantesClientes"
            @limpar-filtros="limparFiltros"
            @carregar-clientes="carregarClientes"
        />

        <RepresentantesClientesCidadesTable
            :representantes="representantes"
            :carregando="carregando"
            :paginatedRepresentantes="paginatedRepresentantesClientes"
            :paginaAtual="paginaAtual"
            :totalPages="totalPages"
            @change-page="changePage"
        />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import SearchForm from '../../components/SearchForms/RepresentantesClientesSearchForm.vue';
import RepresentantesClientesCidadesTable from '../../components/Tables/RepresentantesClientesCidadesTable.vue';
import { getDados } from '../../helpers/axios';

export default {
    name: "ConsultaRepresentantesPorCliente",
    components: {
        Navbar,
        SearchForm,
        RepresentantesClientesCidadesTable
    },
    data() {
        return {
            filtros: {
                cliente_id: '',
            },
            clientes: [],
            representantes: [],
            carregando: false,
            paginaAtual: 1,
            itensPorPagina: 5
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.representantes.length / this.itensPorPagina);
        },
        paginatedRepresentantesClientes() {
            const startIndex = (this.paginaAtual - 1) * this.itensPorPagina;
            return this.representantes.slice(startIndex, startIndex + this.itensPorPagina);
        }
    },
    mounted() {
        this.carregarClientes();
    },
    methods: {
        async carregarClientes() {
            try {
                const response = await getDados('clientes');
                this.clientes = response.resposta || [];
            } catch (error) {
                console.error('Erro ao carregar clientes:', error);
                this.clientes = [];
            }
        },
        async carregarRepresentantesClientes(id) {
            this.carregando = true;
            try {
                const response = await getDados(`relatorios/representantes-por-id-cliente/${id}`);
                this.representantes = Array.isArray(response.resposta) ? response.resposta : [];
            } catch (error) {
                console.error('Erro ao carregar representantes por cliente:', error);
                this.representantes = [];
            } finally {
                this.carregando = false;
            }
        },
        pesquisarRepresentantesClientes() {
            this.paginaAtual = 1;
            this.carregarRepresentantesClientes(this.filtros.cliente_id);
        },
        limparFiltros() {
            this.filtros.cliente_id = '';
            this.representantes = [];
        },
        changePage(pageNumber) {
            this.paginaAtual = pageNumber;
        }
    }
};
</script>

<style scoped>
/* Estilos personalizados, se necessário */
</style>
