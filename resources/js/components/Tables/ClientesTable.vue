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
                    <th>Endereço</th>
                    <th>Estado</th>
                    <th>Cidade</th>
                    <th>Sexo</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="carregando">
                    <td colspan="8">Carregando clientes...</td>
                </tr>
                <tr v-else-if="!clientes.length">
                    <td colspan="8">Nenhum cliente encontrado.</td>
                </tr>
                <tr v-else v-for="cliente in paginatedClientes" :key="cliente.id">
                    <td>
                        <button class="btn btn-primary mb-1" @click="visualizarCliente(cliente)">
                            <i class="bi bi-eye-fill"></i> Visualizar
                        </button><br />
                    </td>
                    <td>{{ cliente.nome }}</td>
                    <td>{{ cliente.cpf }}</td>
                    <td>{{ cliente.data_nascimento }}</td>
                    <td>{{ cliente.endereco }}</td>
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
        visualizarCliente(cliente) {
            this.$router.push('/clientes/visualiza/' + cliente.id);

        },
        changePage(pageNumber) {
            this.$emit('change-page', pageNumber);
        }
    }
};
</script>
