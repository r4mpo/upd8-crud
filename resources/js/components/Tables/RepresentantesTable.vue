<template>
    <div class="section">
        <h5 class="table-title">Resultado da Pesquisa</h5>
        <table id="representantesTable" class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Ações</th>
                    <th>Representante</th>
                    <th>CPF</th>
                    <th>Telefone</th>
                    <th>E-mail</th>
                    <th>Data Nasc.</th>
                    <th>Endereço</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="carregando">
                    <td colspan="10">Carregando representantes...</td>
                </tr>
                <tr v-else-if="!representantes.length">
                    <td colspan="10">Nenhum representante encontrado.</td>
                </tr>
                <tr v-else v-for="representante in paginatedRepresentantes" :key="representante.id">
                    <td>
                        <button class="btn btn-primary mb-1" @click="analisarRepresentante(representante)">
                            <i class="bi bi-eye-fill"></i> Analisar
                        </button><br />
                    </td>
                    <td>{{ representante.nome }}</td>
                    <td>{{ representante.cpf }}</td>
                    <td>{{ representante.telefone }}</td>
                    <td>{{ representante.email }}</td>
                    <td>{{ representante.data_nascimento }}</td>
                    <td>{{ representante.endereco }}</td>
                    <td>{{ representante.estado }}</td>
                    <td>{{ representante.cidade }}</td>
                    <td>{{ representante.sexo }}</td>
                </tr>
            </tbody>
        </table>
        <Pagination v-if="$props.representantes.length > 0" :paginaAtual="paginaAtual" :totalPages="totalPages"
            @change-page="changePage" />
    </div>
</template>

<script>
import Pagination from '../Paginations/RepresentantesPagination.vue';

export default {
    components: { Pagination },
    props: {
        representantes: Array,
        carregando: Boolean,
        paginatedRepresentantes: Array,
        paginaAtual: Number,
        totalPages: Number
    },
    methods: {
        analisarRepresentante(representante) {
            this.$router.push('/representantes/analisa/' + representante.id);
        },
        changePage(pageNumber) {
            this.$emit('change-page', pageNumber);
        }
    }
};
</script>
