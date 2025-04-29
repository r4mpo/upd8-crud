<template>
    <div class="container-custom">
        <!-- Navbar -->
        <nav class="navbar d-flex justify-content-between align-items-center p-2">
            <div class="logo">
                <router-link to="/" class="d-flex align-items-center">
                    <img src="../../../../public/images/upd8.png" width="40" height="40" alt="Logo empresa upd8"
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

        <!-- Formulário -->
        <div class="section">
            <h5 class="form-title">Consulta Cliente</h5>
            <form @submit.prevent="pesquisarClientes" @reset="limparFiltros">
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">CPF :</label>
                        <input type="text" class="form-control" v-model="filtros.cpf" v-mask="'###.###.###-##'"
                            placeholder="Digite o CPF" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nome :</label>
                        <input type="text" class="form-control" v-model="filtros.nome" placeholder="Digite o nome" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data Nascimento:</label>
                        <input type="date" class="form-control" v-model="filtros.data_nascimento" />
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sexo:</label><br />
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="masculino" value="M"
                                v-model="filtros.sexo" />
                            <label class="form-check-label" for="masculino">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="feminino" value="F"
                                v-model="filtros.sexo" />
                            <label class="form-check-label" for="feminino">Feminino</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Estado:</label>
                        <select class="form-select" v-model="filtros.estado" @change="carregarCidades">
                            <option value="">Todos</option>
                            <option v-for="estado in estados" :key="estado.uf" :value="estado.uf">{{ estado.nome }}
                            </option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cidade:</label>
                        <select class="form-select" v-model="filtros.cidade_id">
                            <option value="">Todos</option>
                            <option v-for="cidade in cidades" :key="cidade.id" :value="cidade.id">{{ cidade.nome }}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-search me-2">
                            <i class="bi bi-search"></i> Pesquisar
                        </button>
                        <button type="reset" class="btn btn-clear">
                            <i class="bi bi-x-circle-fill"></i> Limpar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Resultado -->
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
                    <tr v-for="cliente in clientes" :key="cliente.id">
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
                    <tr v-if="!clientes.length">
                        <td colspan="7">Nenhum cliente encontrado.</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
import $ from 'jquery';
import 'datatables.net';
import { getDados } from '../../helpers/axios';
import { mask } from 'vue-the-mask';

export default {
    name: "ConsultaClientes",
    directives: { mask },
    data() {
        return {
            filtros: {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: ''
            },
            estados: [],
            cidades: [],
            clientes: [],
            tabela: null,
        };
    },
    mounted() {
        this.carregarEstados();
        this.carregarClientes();
    },
    methods: {
        async carregarEstados() {
            try {
                const response = await getDados('renders/combo-box-estados');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.estados = [...doc.querySelectorAll('option')]
                    .filter(opt => opt.value)
                    .map(opt => ({ uf: opt.value, nome: opt.textContent }));
            } catch (error) {
                console.error('Erro ao carregar estados:', error);
            }
        },
        async carregarCidades() {
            if (!this.filtros.estado) return (this.cidades = []);
            try {
                const response = await getDados('renders/combo-box-cidades');
                const parser = new DOMParser();
                const doc = parser.parseFromString(response.resposta, 'text/html');
                this.cidades = [...doc.querySelectorAll('option')]
                    .filter(opt => opt.value && opt.dataset.uf === this.filtros.estado)
                    .map(opt => ({ id: opt.value, uf: opt.dataset.uf, nome: opt.textContent }));
            } catch (error) {
                console.error('Erro ao carregar cidades:', error);
            }
        },
        async carregarClientes(queryParams = '') {
    try {
        const response = await getDados('clientes' + queryParams);
        
        // Se já existe DataTable, destrua e tire a referência
        if (this.tabela) {
            this.tabela.destroy();
            this.tabela = null;
        }

        // Atualiza o array de clientes (Vue renderiza o v-for)
        this.clientes = Array.isArray(response.resposta) ? response.resposta : [];

        // Aguarda o Vue atualizar o DOM
        this.$nextTick(() => {
            // Agora que o Vue atualizou, monta o DataTable
            this.tabela = $('#clientesTable').DataTable({
                searching: false,
                paging: true,
                info: true,
                ordering: false,
                autoWidth: false,
                language: {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "Nenhum registro encontrado",
                    "info": "Página _PAGE_ de _PAGES_",
                    "infoEmpty": "Nenhum cliente disponível",
                    "infoFiltered": "(filtrado de _MAX_ registros totais)",
                    "paginate": {
                        "first": "Primeiro",
                        "last": "Último",
                        "next": "Próximo",
                        "previous": "Anterior"
                    }
                }
            });
        });
    } catch (error) {
        console.error('Erro ao carregar clientes:', error);
        this.clientes = [];
    }
},
        pesquisarClientes() {
            const filtrosLimpos = {
                ...this.filtros,
                cpf: this.filtros.cpf.replace(/\D/g, '')
            };
            const params = new URLSearchParams(filtrosLimpos).toString();
            this.carregarClientes('?' + params);
        },
        limparFiltros() {
            this.filtros = {
                cpf: '',
                nome: '',
                data_nascimento: '',
                sexo: '',
                estado: '',
                cidade_id: ''
            };
            this.cidades = [];
        },
        editarCliente(cliente) {
            console.log('Editar cliente:', cliente);
        },
        excluirCliente(cliente) {
            console.log('Excluir cliente:', cliente);
        },
        logOut() {
            console.log('Fazer logout');
        }
    }
};
</script>

<style scoped>
body {
    padding: 20px;
    background-color: #fff;
}

.container-custom {
    border-radius: 10px;
    width: 80%;
    margin: 0 auto;
}

.section {
    border: 1px solid #aaa;
    border-radius: 10px;
    padding: 20px;
    margin-bottom: 20px;
}

.form-title,
.table-title {
    color: purple;
    font-weight: bold;
    margin-bottom: 15px;
}

.btn-search {
    background-color: #007bff;
    color: #fff;
}

.btn-clear {
    background-color: #d3d3d3;
    color: #000;
}

.btn-edit {
    background-color: #28a745;
    color: #fff;
    font-weight: bold;
    border: none;
    width: 70px;
}

.btn-delete {
    background-color: #dc3545;
    color: #fff;
    font-weight: bold;
    border: none;
    width: 70px;
}

.logo {
    max-width: 150px;
    margin-bottom: 10px;
}

table th,
table td {
    vertical-align: middle;
    text-align: center;
}

/* Remove qualquer classe automática aplicada pelo DataTables */
#clientesTable td {
    text-align: center !important;
}

/* Caso haja uma classe específica de tipo numérico, força o alinhamento à esquerda */
#clientesTable td.dt-type-numeric {
    text-align: center !important;
}

/* Garantir que todas as células de tabela sejam alinhadas à esquerda */
#clientesTable th,
#clientesTable td {
    text-align: center !important;
}
</style>