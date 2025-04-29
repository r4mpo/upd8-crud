<template>
    <div class="container-custom">
        <Navbar />
        <SearchForm :filtros="filtros" :estados="estados" :cidades="cidades" @pesquisar-clientes="pesquisarClientes"
            @limpar-filtros="limparFiltros" @carregar-cidades="carregarCidades" />
        <ClientesTable :clientes="clientes" :carregando="carregando" :paginatedClientes="paginatedClientes"
            :paginaAtual="paginaAtual" :totalPages="totalPages" @change-page="changePage" />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import SearchForm from '../../components/SearchForms/ClientesSearchForm.vue';
import ClientesTable from '../../components/Tables/ClientesTable.vue';
import { getDados } from '../../helpers/axios';

export default {
    name: "ConsultaClientes",
    components: { Navbar, SearchForm, ClientesTable },
    data() {
        return {
            filtros: {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: ''
            },
            estados: [],
            cidades: [],
            clientes: [],
            carregando: false,
            paginaAtual: 1,
            itensPorPagina: 5
        };
    },
    computed: {
        totalPages() {
            return Math.ceil(this.clientes.length / this.itensPorPagina);
        },
        paginatedClientes() {
            const startIndex = (this.paginaAtual - 1) * this.itensPorPagina;
            const endIndex = startIndex + this.itensPorPagina;
            return this.clientes.slice(startIndex, endIndex);
        }
    },
    mounted() {
        this.carregarEstados();
        this.carregarClientes();
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
        async carregarCidades() {
            if (!this.filtros.estado) {
                this.cidades = [];
                return;
            }
            try {
                const response = await getDados('renders/combo-box-cidades');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.cidades = [...doc.querySelectorAll('option')].filter(opt => opt.value && opt.dataset.uf === this.filtros.estado).map(opt => ({ id: opt.value, uf: opt.dataset.uf, nome: opt.textContent }));
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
            }
        },
        async carregarClientes(queryParams = '') {
            this.carregando = true;
            try {
                const response = await getDados('clientes' + queryParams);
                this.clientes = Array.isArray(response.resposta) ? response.resposta : [];
            } catch (error) {
                console.error('Erro ao carregar clientes:', error);
                this.clientes = [];
            } finally {
                this.carregando = false;
            }
        },
        pesquisarClientes() {
            this.paginaAtual = 1;
            const filtrosLimpos = {
                ...this.filtros,
                cpf: this.filtros.cpf.replace(/\D/g, '')
            };
            const params = new URLSearchParams(filtrosLimpos).toString();
            this.carregarClientes('?' + params);
        },
        limparFiltros() {
            this.filtros = {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: ''
            };
            this.cidades = [];
            this.carregarClientes();
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