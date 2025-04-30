<template>
    <div class="container-custom">
        <Navbar />

        <SearchForm
            :filtros="filtros"
            :cidades="cidades"
            @pesquisar-representantes-cidades="pesquisarRepresentantesCidades"
            @limpar-filtros="limparFiltros"
            @carregar-cidades="carregarCidades"
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
import SearchForm from '../../components/SearchForms/RepresentantesCidadesSearchForm.vue';
import RepresentantesClientesCidadesTable from '../../components/Tables/RepresentantesClientesCidadesTable.vue';
import { getDados } from '../../helpers/axios';

export default {
    name: "ConsultaRepresentantesPorCidade",
    components: {
        Navbar,
        SearchForm,
        RepresentantesClientesCidadesTable
    },
    data() {
        return {
            filtros: {
                cidade_id: '',
            },
            cidades: [],
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
        this.carregarCidades();
    },
    methods: {
        async carregarCidades() {
            try {
                const response = await getDados('cidades');
                this.cidades = response.resposta || [];
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
                this.cidades = [];
            }
        },
        async carregarRepresentantesCidades(id) {
            this.carregando = true;
            try {
                const response = await getDados(`relatorios/representantes-por-id-cidade/${id}`);
                this.representantes = Array.isArray(response.resposta) ? response.resposta : [];
            } catch (error) {
                console.error('Erro ao carregar representantes por cidade:', error);
                this.representantes = [];
            } finally {
                this.carregando = false;
            }
        },
        pesquisarRepresentantesCidades() {
            this.paginaAtual = 1;
            this.carregarRepresentantesCidades(this.filtros.cidade_id);
        },
        limparFiltros() {
            this.filtros.cidade_id = '';
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
