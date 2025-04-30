<template>
    <div class="section">
        <h5 class="form-title">Analisar Cidade</h5>
        <form @submit.prevent="registrarCidades" @reset="limparCampos">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Nome :</label>
                    <input type="text" class="form-control" :class="{ 'is-invalid': erros.estado }" v-model="campos.nome" placeholder="Digite o nome" />
                    <div v-if="erros.nome" class="invalid-feedback">{{ erros.nome }}</div>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Estado:</label>
                    <select class="form-select" :class="{ 'is-invalid': erros.estado }" v-model="campos.estado">
                        <option value="">Todos</option>
                        <option v-for="estado in estados" :key="estado.uf" :value="estado.uf">{{ estado.nome }}</option>
                    </select>
                    <div v-if="erros.estado" class="invalid-feedback">{{ erros.estado }}</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6" v-if="!modoEdicao">
                    <button type="submit" class="btn btn-search me-2">
                        <i class="bi bi-plus-square"></i> Registrar
                    </button>
                    <button type="reset" class="btn btn-clear me-2">
                        <i class="bi bi-x-circle-fill"></i> Limpar
                    </button>
                </div>
                <div class="col-md-6" v-if="modoEdicao">
                    <button type="submit" class="btn btn-search me-2">
                        <i class="bi bi-pencil-square"></i> Atualizar
                    </button>
                    <button type="button" class="btn btn-danger" @click="$emit('excluir-cidade')">
                        <i class="bi bi-trash-fill"></i> Excluir
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>

import { mask } from 'vue-the-mask';

export default {
    data() {
        return {
            hoverCard: '',
            erros: {}
        };
    },
    directives: {
        mask
    },
    props: {
        campos: Object,
        estados: Array,
        modoEdicao: Boolean
    },
    methods: {
        validarFormulario() {
            this.erros = {};

            if (!this.campos.nome) this.erros.nome = 'Nome é obrigatório';
            if (!this.campos.estado) this.erros.estado = 'Estado é obrigatório';

            return Object.keys(this.erros).length === 0;
        },
        registrarCidades() {
            if (!this.validarFormulario()) return;
            this.$emit('registrar-cidades');
        },
        limparCampos() {
            this.erros = {};
            this.$emit('limpar-campos');
        },
        carregarCidades() {
            this.$emit('carregar-cidades');
        }
    }
};
</script>

<style>
.is-invalid {
    border-color: #dc3545;
}

.invalid-feedback {
    color: #dc3545;
    font-size: 0.875em;
}
</style>