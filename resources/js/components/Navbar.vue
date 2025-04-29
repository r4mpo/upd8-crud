<template>
    <nav class="navbar d-flex justify-content-between align-items-center p-2">
        <div class="logo">
            <router-link to="/" class="d-flex align-items-center">
                <img src="../../../public/images/upd8.png" width="40" height="40" alt="Logo empresa upd8"
                    class="me-2" />
                <span>upd8</span>
            </router-link>
        </div>
        <div>
            <a href="#" @click="logOut" title="Sair">
                <i class="bi bi-box-arrow-right fs-4"></i>
            </a>
        </div>
    </nav>
</template>

<script>
export default {
    name: 'Navbar',
    data() {
        return {

        }
    },
    mounted() {
        // 
    },
    methods: {
        logOut() {
            sessionStorage.removeItem('token');
            this.$router.push('/login').then(() => {
                window.location.reload(); // força recarregamento após a navegação
            });
        },
    }
}
</script>
