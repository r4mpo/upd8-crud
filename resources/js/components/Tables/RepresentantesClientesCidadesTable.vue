<template>
    <div class="table-responsive mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Endereço</th>
                    <th>Telefone</th>
                    <th>Email</th>
                    <th>Cidade</th>
                </tr>
            </thead>
            <tbody>
                <tr v-if="carregando">
                    <td colspan="5">Carregando representantes...</td>
                </tr>
                <tr v-else-if="representantes.length === 0">
                    <td colspan="5">Nenhum representante encontrado.</td>
                </tr>
                <tr v-else v-for="representante in paginatedRepresentantes" :key="representante.id">
                    <td>{{ representante.nome }}</td>
                    <td>{{ representante.endereco }}</td>
                    <td>{{ representante.telefone }}</td>
                    <td>{{ representante.email }}</td>
                    <td>{{ representante.cidade }}</td>
                </tr>
            </tbody>
        </table>

        <nav v-if="totalPages > 1" class="mt-3">
            <ul class="pagination justify-content-center">
                <li v-for="page in totalPages" :key="page" class="page-item" :class="{ active: page === paginaAtual }">
                    <button class="page-link" @click="$emit('change-page', page)">
                        {{ page }}
                    </button>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    props: {
        representantes: Array,
        carregando: Boolean,
        paginatedRepresentantes: Array,
        paginaAtual: Number,
        totalPages: Number
    }
};
</script>
