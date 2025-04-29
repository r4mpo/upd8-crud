<template>
    <div class="container-custom">
        <Navbar />
        <DBForm :campos="campos" :estados="estados" :cidades="cidades" @registrar-clientes="registrarClientes"
            @limpar-campos="limparFiltros" @carregar-cidades="carregarCidades" />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import DBForm from '../../components/DBForms/ClientesDBForm.vue';
import { getDados, postDados } from '../../helpers/axios';

export default {
    name: "RegistraClientes",
    components: { Navbar, DBForm },
    data() {
        return {
            campos: {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: ''
            },
            retorno: {
                icone: 'error',
                titulo: 'Ops...',
                mensagem: 'Houve um erro inesperado',
            },
            estados: [],
            cidades: [],
        };
    },
    computed: {
        //
    },
    mounted() {
        this.carregarEstados();
    },
    methods: {
        async carregarEstados() {
            try {
                const response = await getDados('renders/combo-box-estados');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.estados = [...doc.querySelectorAll('option')].filter(opt => opt.value).map(opt => ({ uf: opt.value, nome: opt.textContent }));
            } catch (error) {
                console.error('Erro ao carregar estados:', error);
            }
        },
        async carregarCidades() {
            if (!this.campos.estado) {
                this.cidades = [];
                return;
            }
            try {
                const response = await getDados('renders/combo-box-cidades');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.cidades = [...doc.querySelectorAll('option')].filter(opt => opt.value && opt.dataset.uf === this.campos.estado).map(opt => ({ id: opt.value, uf: opt.dataset.uf, nome: opt.textContent }));
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
            }
        },
        async enviarDados(campos) {
            try {
                const response = await postDados('clientes', campos);

                if (response.codigo_resposta == 111) {
                    this.retorno.icone = 'success';
                    this.retorno.titulo = 'Sucesso!';
                    this.retorno.mensagem = 'Informações dos clientes atualizadas com sucesso!'
                }
                this.clientes = Array.isArray(response.resposta) ? response.resposta : [];
            } catch (error) {
                if (error.response.data.resposta) {
                    let detalhes_erro = error.response.data.resposta;
                    this.retorno.mensagem = Array.isArray(detalhes_erro) ? (detalhes_erro).join('\n') : detalhes_erro;
                }
            } finally {
                Swal.fire({
                    title: this.retorno.titulo,
                    text: this.retorno.mensagem,
                    icon: this.retorno.icone
                });
            }
        },
        registrarClientes() {
            const campos = {
                ...this.campos,
                cpf: this.campos.cpf.replace(/\D/g, '')
            };
            this.enviarDados(campos);
        },
        limparFiltros() {
            this.campos = {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: ''
            };
            this.cidades = [];
            this.carregarClientes();
        },
    }
};
</script>

<style scoped>
/*  */
</style>