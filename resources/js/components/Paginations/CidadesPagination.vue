<template>
    <div class="pagination-controls">
        <button class="btn-pagination" :disabled="paginaAtual === 1" @click="changePage(paginaAtual - 1)">
            Anterior
        </button>
        <span>Página {{ paginaAtual }} de {{ totalPages }}</span>
        <button class="btn-pagination" :disabled="paginaAtual === totalPages" @click="changePage(paginaAtual + 1)">
            Próximo
        </button>
    </div>
</template>

<script>
export default {
    props: {
        paginaAtual: Number,
        totalPages: Number
    },
    methods: {
        changePage(pageNumber) {
            this.$emit('change-page', pageNumber);
        }
    }
};
</script>
