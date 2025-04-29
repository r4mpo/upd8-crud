<template>
    <div class="section">
        <h5 class="form-title">Consulta Representante</h5>
        <form @submit.prevent="pesquisarRepresentantes" @reset="limparFiltros">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">CPF :</label>
                    <input type="text" class="form-control" v-model="filtros.cpf" v-mask="'###.###.###-##'" placeholder="Digite o CPF" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Nome :</label>
                    <input type="text" class="form-control" v-model="filtros.nome" placeholder="Digite o nome" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Data Nascimento:</label>
                    <input type="date" class="form-control" v-model="filtros.data_nascimento" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">Sexo:</label><br />
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M" v-model="filtros.sexo" />
                        <label class="form-check-label" for="masculino">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="sexo" id="feminino" value="F" v-model="filtros.sexo" />
                        <label class="form-check-label" for="feminino">Feminino</label>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Telefone :</label>
                    <input type="text" class="form-control" v-mask="'(##) #####-####'" v-model="filtros.telefone" placeholder="Digite o telefone" />
                </div>
                <div class="col-md-3">
                    <label class="form-label">E-mail :</label>
                    <input type="text" class="form-control" v-model="filtros.email" placeholder="Digite o e-mail" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Estado:</label>
                    <select class="form-select" v-model="filtros.estado" @change="carregarCidades">
                        <option value="">Todos</option>
                        <option v-for="estado in estados" :key="estado.uf" :value="estado.uf">{{ estado.nome }}</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Cidade:</label>
                    <select class="form-select" v-model="filtros.cidade_id">
                        <option value="">Todos</option>
                        <option v-for="cidade in cidades" :key="cidade.id" :value="cidade.id">{{ cidade.nome }}</option>
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
        pesquisarRepresentantes() {
            this.$emit('pesquisar-representantes');
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
