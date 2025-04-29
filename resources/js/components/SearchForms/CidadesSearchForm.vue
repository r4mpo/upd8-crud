<template>
    <div class="section">
        <h5 class="form-title">Consulta Cidade</h5>
        <form @submit.prevent="pesquisarCidades" @reset="limparFiltros">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Nome :</label>
                    <input type="text" class="form-control" v-model="filtros.nome" placeholder="Digite o nome" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado:</label>
                    <select class="form-select" v-model="filtros.estado" @change="carregarCidades">
                        <option value="">Todos</option>
                        <option v-for="estado in estados" :key="estado.uf" :value="estado.uf">{{ estado.nome }}</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <button type="submit" class="btn btn-search me-2">
                        <i class="bi bi-search"></i> Pesquisar
                    </button>
                    <button type="reset" class="btn btn-clear">
                        <i class="bi bi-x-circle-fill"></i> Limpar
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

import { mask } from 'vue-the-mask';

export default {
    directives: {
        mask
    },
    props: {
        filtros: Object,
        estados: Array,
        cidades: Array,
    },
    methods: {
        pesquisarCidades() {
            this.$emit('pesquisar-cidades');
        },
        limparFiltros() {
            this.$emit('limpar-filtros');
        },
        carregarCidades() {
            this.$emit('carregar-cidades');
        }
    }
};
</script>
