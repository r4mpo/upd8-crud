<template>
    <div class="section">
        <h5 class="form-title">Analisar Cliente</h5>
        <form @submit.prevent="registrarClientes" @reset="limparCampos">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">CPF :</label>
                    <input type="text" class="form-control" v-model="campos.cpf" v-mask="'###.###.###-##'"
                        :class="{ 'is-invalid': erros.cpf }" placeholder="Digite o CPF" />
                    <div v-if="erros.cpf" class="invalid-feedback">{{ erros.cpf }}</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Nome :</label>
                    <input type="text" class="form-control" v-model="campos.nome" :class="{ 'is-invalid': erros.nome }"
                        placeholder="Digite o nome" />
                    <div v-if="erros.nome" class="invalid-feedback">{{ erros.nome }}</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Data Nascimento:</label>
                    <input type="date" class="form-control" v-model="campos.data_nascimento"
                        :class="{ 'is-invalid': erros.data_nascimento }" />
                    <div v-if="erros.data_nascimento" class="invalid-feedback">{{ erros.data_nascimento }}</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Sexo:</label><br />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M"
                            v-model="campos.sexo" />
                        <label class="form-check-label" for="masculino">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="feminino" value="F"
                            v-model="campos.sexo" />
                        <label class="form-check-label" for="feminino">Feminino</label>
                    </div>
                    <div v-if="erros.sexo" class="invalid-feedback d-block">{{ erros.sexo }}</div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Endereço :</label>
                    <input type="text" class="form-control" v-model="campos.endereco"
                        :class="{ 'is-invalid': erros.endereco }" placeholder="Digite o endereco" />
                    <div v-if="erros.endereco" class="invalid-feedback">{{ erros.endereco }}</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Estado:</label>
                    <select class="form-select" v-model="campos.estado" @change="carregarCidades"
                        :class="{ 'is-invalid': erros.estado }">
                        <option value="">Todos</option>
                        <option v-for="estado in estados" :key="estado.uf" :value="estado.uf">{{ estado.nome }}</option>
                    </select>
                    <div v-if="erros.estado" class="invalid-feedback">{{ erros.estado }}</div>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Cidade:</label>
                    <select class="form-select" v-model="campos.cidade_id" :class="{ 'is-invalid': erros.cidade_id }">
                        <option value="">Todos</option>
                        <option v-for="cidade in cidades" :key="cidade.id" :value="cidade.id">{{ cidade.nome }}</option>
                    </select>
                    <div v-if="erros.cidade_id" class="invalid-feedback">{{ erros.cidade_id }}</div>
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
                    <button type="button" class="btn btn-danger" @click="$emit('excluir-cliente')">
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
        cidades: Array,
        modoEdicao: Boolean
    },
    methods: {
        validarFormulario() {
            this.erros = {};

            if (!this.campos.cpf) this.erros.cpf = 'CPF é obrigatório';
            if (!this.campos.nome) this.erros.nome = 'Nome é obrigatório';
            if (!this.campos.data_nascimento) this.erros.data_nascimento = 'Data de nascimento é obrigatória';
            if (!this.campos.sexo) this.erros.sexo = 'Selecione o sexo';
            if (!this.campos.endereco) this.erros.endereco = 'Endereço é obrigatório';
            if (!this.campos.estado) this.erros.estado = 'Selecione o estado';
            if (!this.campos.cidade_id) this.erros.cidade_id = 'Selecione a cidade';

            return Object.keys(this.erros).length === 0;
        },
        registrarClientes() {
            if (!this.validarFormulario()) return;
            this.$emit('registrar-clientes');
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