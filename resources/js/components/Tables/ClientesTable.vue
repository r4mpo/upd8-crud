<template>
    <div class="section">
        <h5 class="table-title">Resultado da Pesquisa</h5>
        <table id="clientesTable" class="table table-bordered">
            <thead class="table-secondary">
                <tr>
                    <th>Ações</th>
                    <th>Cliente</th>
                    <th>CPF</th>
                    <th>Data Nasc.</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="carregando">
                    <td colspan="7">Carregando clientes...</td>
                </tr>
                <tr v-else-if="!clientes.length">
                    <td colspan="7">Nenhum cliente encontrado.</td>
                </tr>
                <tr v-else v-for="cliente in paginatedClientes" :key="cliente.id">
                    <td>
                        <button class="btn btn-edit mb-1" @click="editarCliente(cliente)">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button><br />
                        <button class="btn btn-delete" @click="excluirCliente(cliente)">
                            <i class="bi bi-trash3"></i> Excluir
                        </button>
                    </td>
                    <td>{{ cliente.nome }}</td>
                    <td>{{ cliente.cpf }}</td>
                    <td>{{ cliente.data_nascimento }}</td>
                    <td>{{ cliente.estado }}</td>
                    <td>{{ cliente.cidade }}</td>
                    <td>{{ cliente.sexo }}</td>
                </tr>
            </tbody>
        </table>
        <Pagination v-if="$props.clientes.length > 0" :paginaAtual="paginaAtual" :totalPages="totalPages" @change-page="changePage" />
    </div>
</template>

<script>
import Pagination from '../Paginations/ClientesPagination.vue';

export default {
    components: { Pagination },
    props: {
        clientes: Array,
        carregando: Boolean,
        paginatedClientes: Array,
        paginaAtual: Number,
        totalPages: Number
    },
    methods: {
        editarCliente(cliente) {
            console.log('Editar cliente:', cliente);
        },
        excluirCliente(cliente) {
            console.log('Excluir cliente:', cliente);
        },
        changePage(pageNumber) {
            this.$emit('change-page', pageNumber);
        }
    }
};
</script>
