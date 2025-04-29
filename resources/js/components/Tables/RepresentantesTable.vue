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
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="carregando">
                    <td colspan="9">Carregando representantes...</td>
                </tr>
                <tr v-else-if="!representantes.length">
                    <td colspan="9">Nenhum cliente encontrado.</td>
                </tr>
                <tr v-else v-for="cliente in paginatedRepresentantes" :key="cliente.id">
                    <td>
                        <button class="btn btn-edit mb-1" @click="editarRepresentante(cliente)">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button><br />
                        <button class="btn btn-delete" @click="excluirRepresentante(cliente)">
                            <i class="bi bi-trash3"></i> Excluir
                        </button>
                    </td>
                    <td>{{ cliente.nome }}</td>
                    <td>{{ cliente.cpf }}</td>
                    <td>{{ cliente.telefone }}</td>
                    <td>{{ cliente.email }}</td>
                    <td>{{ cliente.data_nascimento }}</td>
                    <td>{{ cliente.estado }}</td>
                    <td>{{ cliente.cidade }}</td>
                    <td>{{ cliente.sexo }}</td>
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
        editarRepresentante(cliente) {
            console.log('Editar cliente:', cliente);
        },
        excluirRepresentante(cliente) {
            console.log('Excluir cliente:', cliente);
        },
        changePage(pageNumber) {
            this.$emit('change-page', pageNumber);
        }
    }
};
</script>
