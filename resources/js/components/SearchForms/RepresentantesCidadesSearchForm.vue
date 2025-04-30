<template>
    <div class="section">
        <h5 class="form-title">Consulta Representantes por Cidade</h5>

        <form @submit.prevent="pesquisar" @reset.prevent="limpar">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Cidade:</label>
                    <select class="form-select" v-model="filtros.cidade_id">
                        <option value="">Todas</option>
                        <option v-for="cidade in cidades" :key="cidade.id" :value="cidade.id">
                            {{ cidade.nome }}
                        </option>
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
export default {
    props: {
        filtros: Object,
        cidades: Array,
    },
    methods: {
        pesquisar() {
            this.$emit('pesquisar-representantes-cidades');
        },
        limpar() {
            this.$emit('limpar-filtros');
        }
    }
};
</script>