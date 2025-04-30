<template>
    <div class="section">
        <h5 class="table-title">Resultado da Pesquisa</h5>
        <table id="cidadesTable" class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Ações</th>
                    <th>Nome</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="carregando">
                    <td colspan="3">Carregando cidades...</td>
                </tr>
                <tr v-else-if="!cidades.length">
                    <td colspan="3">Nenhuma cidade encontrada.</td>
                </tr>
                <tr v-else v-for="cidade in paginatedCidades" :key="cidade.id">
                    <td>
                        <button class="btn btn-primary mb-1" @click="analisarCidade(cidade)">
                            <i class="bi bi-eye-fill"></i> Analisar
                        </button><br />
                    </td>
                    <td>{{ cidade.nome }}</td>
                    <td>{{ cidade.estado }}</td>
                </tr>
            </tbody>
        </table>
        <Pagination v-if="$props.cidades.length > 0" :paginaAtual="paginaAtual" :totalPages="totalPages" @change-page="changePage" />
    </div>
</template>

<script>
import Pagination from '../Paginations/CidadesPagination.vue';

export default {
    components: { Pagination },
    props: {
        cidades: Array,
        carregando: Boolean,
        paginatedCidades: Array,
        paginaAtual: Number,
        totalPages: Number
    },
    methods: {
        analisarCidade(cidade) {
            this.$router.push('/cidades/analisa/' + cidade.id);
        },
        changePage(pageNumber) {
            this.$emit('change-page', pageNumber);
        }
    }
};
</script>
