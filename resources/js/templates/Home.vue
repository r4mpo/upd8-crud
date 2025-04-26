<template>
    <div class="mb-5">
        <Navbar></Navbar>
        <div class="container-fluid mt-4">
            <button class="btn btn-primary mb-3" @click="adicionarRegistro">Adicionar Novo</button>

            <div class="table-responsive">
                <table id="tabela" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Título</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in dados" :key="item.id">
                            <td class="text-center">{{ item.id }}</td>
                            <td class="text-center">
                                <span :class="{ 'text-success': item.status, 'text-danger': !item.status }">
                                    {{ item.status ? 'Finalizada' : 'Pendente' }}
                                </span>
                            </td>
                            <td>{{ item.titulo }}</td>
                            <td class="text-center">
                                <button title="Editar tarefa" class="btn btn-warning btn-sm mr-1"
                                    @click="editarRegistro(item)">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button title="Excluir tarefa" class="btn btn-danger btn-sm mr-1"
                                    @click="excluirRegistro(item.id)">
                                    <i class="bi bi-trash3"></i>
                                </button>
                                <button title="Atualizar status" class="btn btn-info btn-sm"
                                    @click="alterarStatus(item)">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import $ from 'jquery';
import 'datatables.net-bs4';
import 'datatables.net-responsive-bs4';
import { deleteDados, getDados, postDados, putDados } from '../helpers/axios';
import Navbar from '../components/Navbar.vue';

export default {
    name: "Home",
    data() {
        return {
            dados: [],
            tabela: null
        };
    },
    components: {
        Navbar
    },
    async mounted() {
        await this.recuperarRegistros();
    },
    methods: {
        async recuperarRegistros() {
            try {
                const resposta = await getDados('tarefas');
                this.dados = resposta.resposta;

                this.$nextTick(() => {
                    if (this.tabela) {
                        this.tabela.destroy();
                    }
                    this.tabela = $('#tabela').DataTable({
                        language: {
                            "lengthMenu": "Mostrar _MENU_ registros por página",
                            "zeroRecords": "Nenhum registro encontrado",
                            "info": "Página _PAGE_ de _PAGES_",
                            "infoEmpty": "Nenhum dado disponível",
                            "infoFiltered": "(filtrado de _MAX_ registros totais)",
                            "search": "Pesquisar:",
                            "paginate": {
                                "first": "Primeiro",
                                "last": "Último",
                                "next": "Próximo",
                                "previous": "Anterior"
                            }
                        },
                        dom: "<'row'<'col-md-6'f>>t<'row'<'col-md-12 text-right'p>>"
                    });
                });
            } catch (erro) {
                this.exibirMensagem('Ops!', 'Nenhuma tarefa foi encontrada, tente novamente!', 'error');
            }
        },
        adicionarRegistro() {
            Swal.fire({
                title: 'Adicionar Nova Tarefa',
                html: `
                    <input id="titulo" class="swal2-input" placeholder="Título da Tarefa">
                    <select id="status" class="swal2-input">
                        <option value="false">Pendente</option>
                        <option value="true">Finalizada</option>
                    </select>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const titulo = document.getElementById('titulo').value;
                    const status = document.getElementById('status').value === 'true';
                    if (!titulo) {
                        Swal.showValidationMessage('O título é obrigatório');
                    } else {
                        this.adicionarTarefa(titulo, status);
                    }
                }
            });
        },
        async adicionarTarefa(titulo, status) {
            const novaTarefa = {
                titulo,
                status
            };
            const respostaTarefa = await postDados('tarefas', novaTarefa);
            this.dados.push(respostaTarefa.resposta); // Adiciona a nova tarefa no array 'dados'
            this.atualizarTabela();
            this.exibirMensagem('Sucesso', 'Tarefa adicionada com sucesso!', 'success');
        },
        editarRegistro(item) {
            Swal.fire({
                title: 'Editar Tarefa',
                html: `
                    <input id="titulo" class="swal2-input" value="${item.titulo}" placeholder="Título da Tarefa">
                    <select id="status" class="swal2-input">
                        <option value="false" ${item.status ? '' : 'selected'}>Pendente</option>
                        <option value="true" ${item.status ? 'selected' : ''}>Finalizada</option>
                    </select>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const titulo = document.getElementById('titulo').value;
                    const status = document.getElementById('status').value === 'true';
                    if (!titulo) {
                        Swal.showValidationMessage('O título é obrigatório');
                    } else {
                        this.atualizarTarefa(item.id, titulo, status);
                    }
                }
            });
        },
        async atualizarTarefa(id, titulo, status) {
            const respostaTarefa = await putDados('tarefas/' + id, { 'titulo': titulo, 'status': status });
            if (respostaTarefa.codigo_resposta === 111) {
                const tarefa = this.dados.find(item => item.id === id);
                if (tarefa) {
                    tarefa.titulo = titulo;
                    tarefa.status = status;
                    this.atualizarTabela();
                    this.exibirMensagem('Sucesso', 'Tarefa atualizada com sucesso!', 'success');
                }
            } else {
                this.exibirMensagem('Ops', 'Houve um erro ao atualizar a tarefa!', 'error');
            }
        },
        async excluirRegistro(id) {
            const confirmacao = await Swal.fire({
                title: 'Tem certeza?',
                text: "Essa ação não pode ser desfeita.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar'
            });

            if (confirmacao.isConfirmed) {
                const respostaTarefa = await deleteDados('tarefas/' + id);
                if (respostaTarefa.codigo_resposta === 111) {
                    this.dados = this.dados.filter(item => item.id !== id);
                    Swal.fire('Excluído!', 'A tarefa foi excluída.', 'success');

                    if (this.dados.length === 0) {
                        window.location.reload();
                    }
                } else {
                    this.exibirMensagem('Ops', 'Houve um erro ao excluir a tarefa!', 'error');
                }
            }
        },
        alterarStatus(item) {
            item.status = !item.status;
            this.atualizarTarefa(item.id, item.titulo, item.status)
            this.atualizarTabela();
        },
        atualizarTabela() {
            this.$nextTick(() => {
                if (this.tabela) {
                    this.tabela.reload();
                }
                this.tabela = $('#tabela').DataTable({
                    language: {
                        "lengthMenu": "Mostrar _MENU_ registros por página",
                        "zeroRecords": "Nenhum registro encontrado",
                        "info": "Página _PAGE_ de _PAGES_",
                        "infoEmpty": "Nenhum dado disponível",
                        "infoFiltered": "(filtrado de _MAX_ registros totais)",
                        "search": "Pesquisar:",
                        "paginate": {
                            "first": "Primeiro",
                            "last": "Último",
                            "next": "Próximo",
                            "previous": "Anterior"
                        }
                    },
                    dom: "<'row'<'col-md-6'f>>t<'row'<'col-md-12 text-right'p>>"
                });
            });
        },
        exibirMensagem(titulo, texto, icone) {
            Swal.fire({ title: titulo, text: texto, icon: icone });
        },
    }
};
</script>

<style scoped>
.container-fluid {
    max-width: 90%;
}

.table {
    font-size: 1rem;
    width: 100%;
}

.table th,
.table td {
    padding: 8px;
    text-align: center;
}

.btn {
    font-size: 0.9rem;
    padding: 6px 12px;
}

@media (max-width: 768px) {
    .btn {
        font-size: 0.85rem;
        padding: 5px 10px;
    }

    .table th,
    .table td {
        padding: 5px;
    }
}
body,
.container-fluid,
.navbar {
    margin-top: 0 !important;
    padding-top: 0 !important;
}
</style>
