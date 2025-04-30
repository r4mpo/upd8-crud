<template>
    <div class="section">
        <h5 class="form-title">Consulta Representantes por Clientes</h5>

        <form @submit.prevent="pesquisar" @reset.prevent="limpar">
            <div class="row mb-3">
                <div class="col-md-3">
                    <label class="form-label">Cliente:</label>
                    <select class="form-select" v-model="filtros.cliente_id">
                        <option value="">Todas</option>
                        <option v-for="cliente in clientes" :key="cliente.id" :value="cliente.id">
                            {{ cliente.nome }}
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
        clientes: Array,
    },
    methods: {
        pesquisar() {
            this.$emit('pesquisar-representantes-clientes');
        },
        limpar() {
            this.$emit('limpar-filtros');
        }
    }
};
</script>