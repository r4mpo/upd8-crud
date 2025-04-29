<template>
    <div class="container-custom">
        <Navbar />
        <SearchForm :filtros="filtros" :estados="estados" :cidades="cidades"
            @pesquisar-representantes="pesquisarRepresentantes" @limpar-filtros="limparFiltros"
            @carregar-cidades="carregarCidades" />
        <RepresentantesTable :representantes="representantes" :carregando="carregando"
            :paginatedRepresentantes="paginatedRepresentantes" :paginaAtual="paginaAtual" :totalPages="totalPages"
            @change-page="changePage" />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import SearchForm from '../../components/SearchForms/RepresentantesSearchForm.vue';
import RepresentantesTable from '../../components/Tables/RepresentantesTable.vue';
import { getDados } from '../../helpers/axios';

export default {
    name: "ConsultaRepresentantes",
    components: { Navbar, SearchForm, RepresentantesTable },
    data() {
        return {
            filtros: {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: '',
                telefone: '',
                email: ''

            },
            estados: [],
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
        paginatedRepresentantes() {
            const startIndex = (this.paginaAtual - 1) * this.itensPorPagina;
            const endIndex = startIndex + this.itensPorPagina;
            return this.representantes.slice(startIndex, endIndex);
        }
    },
    mounted() {
        this.carregarEstados();
        this.carregarRepresentantes();
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
        async carregarRepresentantes(queryParams = '') {
            this.carregando = true;
            try {
                const response = await getDados('representantes' + queryParams);
                this.representantes = Array.isArray(response.resposta) ? response.resposta : [];
            } catch (error) {
                console.error('Erro ao carregar representantes:', error);
                this.representantes = [];
            } finally {
                this.carregando = false;
            }
        },
        pesquisarRepresentantes() {
            this.paginaAtual = 1;
            const filtrosLimpos = {
                ...this.filtros,
                cpf: this.filtros.cpf.replace(/\D/g, ''),
                telefone: this.filtros.telefone.replace(/\D/g, ''),
            };
            const params = new URLSearchParams(filtrosLimpos).toString();
            this.carregarRepresentantes('?' + params);
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
            this.carregarRepresentantes();
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