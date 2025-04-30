<template>
    <div class="container-custom">
        <Navbar />
        <DBForm :campos="campos" :estados="estados" :cidades="cidades" :modoEdicao="modoEdicao"
            @registrar-representantes="modoEdicao ? atualizarRepresentante() : registrarRepresentantes()" @limpar-campos="limparCampos"
            @carregar-cidades="carregarCidades" @excluir-representante="excluirRepresentante" />
    </div>
</template>

<script>
import Navbar from '../../components/Navbar.vue';
import DBForm from '../../components/DBForms/RepresentantesDBForm.vue';
import { getDados, postDados, putDados, deleteDados } from '../../helpers/axios';

export default {
    name: 'AnalisaRepresentantes',
    components: { Navbar, DBForm },
    data() {
        return {
            campos: {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: '',
                telefone: '',
                email: ''
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
            await this.carregarRepresentante(this.$route.params.id);
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
        async carregarCidades() {
            if (!this.campos.estado) {
                this.cidades = [];
                return;
            }
            try {
                const response = await getDados('renders/combo-box-cidades');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.cidades = [...doc.querySelectorAll('option')].filter(opt => opt.value && opt.dataset.uf === this.campos.estado).map(opt => ({
                    id: opt.value,
                    uf: opt.dataset.uf,
                    nome: opt.textContent
                }));
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
            }
        },
        async carregarRepresentante(id) {
            try {
                const response = await getDados(`representantes/${id}`);
                if (response.codigo_resposta === 111) {

                   this.campos = {
                        cpf: response.resposta.cpf,
                        nome: response.resposta.nome,
                        sexo: response.resposta.sexo,
                        estado: response.resposta.estado,
                        endereco: response.resposta.endereco,
                        cidade_id: response.resposta.cidade_id,
                        data_nascimento: response.resposta.data_nascimento,
                        telefone: response.resposta.telefone,
                        email: response.resposta.email
                    }

                    await this.carregarCidades();
                }
            } catch (error) {
                console.error('Erro ao carregar representante:', error);
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
        registrarRepresentantes() {
            const campos = { ...this.campos, cpf: this.campos.cpf.replace(/\D/g, '') };
            this.enviarDados(campos, (dados) => postDados('representantes', dados));
        },
        atualizarRepresentante() {
            const campos = { ...this.campos, cpf: this.campos.cpf.replace(/\D/g, '') };
            this.enviarDados(campos, (dados) => putDados(`representantes/${this.$route.params.id}`, dados));
        },
        excluirRepresentante() {
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
                        const response = await deleteDados(`representantes/${this.$route.params.id}`);
                        if (response.codigo_resposta === 111) {
                            this.definirRetorno('success', true, 'Excluído!', 'Representante excluído com sucesso.');
                            setTimeout(() => this.redirecionar(), 2000);
                        }
                    } catch (error) {
                        Swal.fire('Erro!', 'Erro ao excluir representante.', 'error');
                    }
                }
            });
        },
        redirecionar() {
            this.$router.push('/representantes/consulta').then(() => window.location.reload());
        },
        definirRetorno(icone, status, titulo, mensagem) {
            this.retorno = { icone, status, titulo, mensagem };
        },
        limparCampos() {
            this.campos = {
                cpf: '', nome: '', data_nascimento: '', sexo: '', estado: '', cidade_id: ''
            };
            this.cidades = [];
        }
    }
};
</script>

<style scoped>
/*  */
</style>