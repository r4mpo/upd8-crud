<template>
    <div class="container-custom">
        <Navbar />
        <DBForm :campos="campos" :estados="estados" :modoEdicao="modoEdicao"
            @registrar-cidades="modoEdicao ? atualizarCidade() : registrarCidades()" @limpar-campos="limparCampos"
            @excluir-cidade="excluirCidade" />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import DBForm from '../../components/DBForms/CidadesDBForm.vue';
import { getDados, postDados, putDados, deleteDados } from '../../helpers/axios';

export default {
    name: 'AnalisaCidades',
    components: { Navbar, DBForm },
    data() {
        return {
            campos: {
                nome: '',
                estado: '',
            },
            retorno: {
                icone: 'error',
                titulo: 'Ops...',
                status: false,
                mensagem: 'Houve um erro inesperado'
            },
            estados: [],
            cidades: [],
            modoEdicao: false
        };
    },
    async mounted() {
        await this.carregarEstados();
        if (this.$route.params.id) {
            this.modoEdicao = true;
            await this.carregarCidade(this.$route.params.id);
        }
    },
    methods: {
        async carregarEstados() {
            try {
                const response = await getDados('renders/combo-box-estados');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.estados = [...doc.querySelectorAll('option')].filter(opt => opt.value).map(opt => ({
                    uf: opt.value,
                    nome: opt.textContent
                }));
            } catch (error) {
                console.error('Erro ao carregar estados:', error);
            }
        },
        async carregarCidade(id) {
            try {
                const response = await getDados(`cidades/${id}`);
                if (response.codigo_resposta === 111) {

                   this.campos = {
                        nome: response.resposta.nome,
                        estado: response.resposta.estado,
                    }
                }
            } catch (error) {
                console.error('Erro ao carregar cidade:', error);
            }
        },
        async enviarDados(campos, metodo) {
            try {
                const response = await metodo(campos);
                if (response.codigo_resposta === 111) {
                    this.definirRetorno('success', true, 'Sucesso!', 'Dados processados com sucesso!');
                }
            } catch (error) {
                let mensagem = 'Houve um erro interno...';
                if (error.response?.data?.resposta) {
                    const detalhes_erro = error.response.data.resposta;
                    mensagem = Array.isArray(detalhes_erro) ? detalhes_erro.join('\n') : detalhes_erro;
                }
                this.definirRetorno('error', false, 'Erro!', mensagem);
            } finally {
                Swal.fire({
                    title: this.retorno.titulo,
                    text: this.retorno.mensagem,
                    icon: this.retorno.icone
                });

                if (this.retorno.status) {
                    setTimeout(() => this.redirecionar(), 1000);
                }
            }
        },
        registrarCidades() {
            const campos = { ...this.campos };
            this.enviarDados(campos, (dados) => postDados('cidades', dados));
        },
        atualizarCidade() {
            const campos = { ...this.campos };
            this.enviarDados(campos, (dados) => putDados(`cidades/${this.$route.params.id}`, dados));
        },
        excluirCidade() {
            Swal.fire({
                title: 'Tem certeza?',
                text: 'Essa ação não poderá ser desfeita!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sim, excluir!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        const response = await deleteDados(`cidades/${this.$route.params.id}`);
                        if (response.codigo_resposta === 111) {
                            this.definirRetorno('success', true, 'Excluído!', 'Cidade excluído com sucesso.');
                            setTimeout(() => this.redirecionar(), 2000);
                        }
                    } catch (error) {
                        Swal.fire('Erro!', 'Erro ao excluir cidade.', 'error');
                    }
                }
            });
        },
        redirecionar() {
            this.$router.push('/cidades/consulta').then(() => window.location.reload());
        },
        definirRetorno(icone, status, titulo, mensagem) {
            this.retorno = { icone, status, titulo, mensagem };
        },
        limparCampos() {
            this.campos = {
                nome: '', estado: ''
            };
            this.cidades = [];
        }
    }
};
</script>

<style scoped>
/*  */
</style>