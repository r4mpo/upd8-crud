<template>
    <div class="container-custom">
        <Navbar />
        <SearchForm :filtros="filtros" :estados="estados" :nome="nome" @pesquisar-cidades="pesquisarCidades"
            @limpar-filtros="limparFiltros" />
        <CidadesTable :cidades="cidades" :carregando="carregando" :paginatedCidades="paginatedCidades"
            :paginaAtual="paginaAtual" :totalPages="totalPages" @change-page="changePage" />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import SearchForm from '../../components/SearchForms/CidadesSearchForm.vue';
import CidadesTable from '../../components/Tables/CidadesTable.vue';
import { getDados } from '../../helpers/axios';

export default {
    name: "ConsultaCidades",
    components: { Navbar, SearchForm, CidadesTable },
    data() {
        return {
            filtros: {
                nome: '',
                estado: '',
            },
            estados: [],
            cidades: [],
            carregando: false,
            paginaAtual: 1,
            itensPorPagina: 5
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.cidades.length / this.itensPorPagina);
        },
        paginatedCidades() {
            const startIndex = (this.paginaAtual - 1) * this.itensPorPagina;
            const endIndex = startIndex + this.itensPorPagina;
            return this.cidades.slice(startIndex, endIndex);
        }
    },
    mounted() {
        this.carregarEstados();
        this.carregarCidades();
    },
    methods: {
        async carregarEstados() {
            try {
                const response = await getDados('renders/combo-box-estados');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.estados = [...doc.querySelectorAll('option')].filter(opt => opt.value).map(opt => ({ uf: opt.value, nome: opt.textContent }));
            } catch (error) {
                console.error('Erro ao carregar estados:', error);
            }
        },
        async carregarCidades(queryParams = '') {
            this.carregando = true;
            try {
                const response = await getDados('cidades' + queryParams);
                this.cidades = Array.isArray(response.resposta) ? response.resposta : [];
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
                this.cidades = [];
            } finally {
                this.carregando = false;
            }
        },
        pesquisarCidades() {
            this.paginaAtual = 1;
            const filtrosLimpos = {
                ...this.filtros,
            };
            const params = new URLSearchParams(filtrosLimpos).toString();
            this.carregarCidades('?' + params);
        },
        limparFiltros() {
            this.filtros = {
                nome: '',
                estado: '',
            };
            this.cidades = [];
            this.carregarCidades();
        },
        changePage(pageNumber) {
            this.paginaAtual = pageNumber;
        }
    }
};
</script>

<style scoped>
/*  */
</style>