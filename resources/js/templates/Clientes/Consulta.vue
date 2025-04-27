<template>
    <div class="container-custom">
        <nav class="navbar d-flex justify-content-between align-items-center p-2">
            <div class="logo">
                <router-link to="/" class="d-flex align-items-center">
                    <img src="../../../../public/images/upd8.png" width="40" height="40" alt="Logo empresa upd8"
                        class="me-2">
                    <span>upd8</span>
                </router-link>
            </div>
            <div class="menu">
                <a href="#" @click="logOut()" title="Sair">
                    <i class="bi bi-box-arrow-right fs-4"></i>
                </a>
            </div>
        </nav>

        <!-- Formulário de Consulta -->
        <div class="section">
            <h5 class="form-title">Consulta Cliente</h5>

            <form>
                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">CPF :</label>
                        <input type="text" class="form-control" value="378.846.758-55" disabled>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Nome :</label>
                        <input type="text" class="form-control" placeholder="Digite o nome">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Data Nascimento:</label>
                        <input type="date" class="form-control" value="2022-06-06">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sexo:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="masculino" checked>
                            <label class="form-check-label" for="masculino">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="sexo" id="feminino">
                            <label class="form-check-label" for="feminino">Feminino</label>
                        </div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Estado:</label>
                        <select class="form-select">
                            <option selected>Todos</option>
                            <option>SP</option>
                            <option>RJ</option>
                            <option>SC</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Cidade:</label>
                        <select class="form-select">
                            <option selected>Todos</option>
                            <option>Guarulhos</option>
                            <option>São Paulo</option>
                            <option>Trindade</option>
                            <option>Vilage</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-search me-2"><i class="bi bi-search"></i> Pesquisar</button>
                        <button type="reset" class="btn btn-clear"><i class="bi bi-x-circle-fill"></i> Limpar</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Resultado da Pesquisa -->
        <div class="section">
            <h5 class="table-title">Resultado da Pesquisa</h5>

            <table class="table table-bordered">
                <thead class="table-light">
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
                    <tr>
                        <td>
                            <button class="btn btn-edit mb-1"><i class="bi bi-pencil-square"></i> Editar</button><br>
                            <button class="btn btn-delete"><i class="bi bi-trash3"></i> Excluir</button>
                        </td>
                        <td>Wesley Barbosa</td>
                        <td>378.658.658-00</td>
                        <td>06/06/1990</td>
                        <td>SP</td>
                        <td>Guarulhos</td>
                        <td>M</td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-edit mb-1"><i class="bi bi-pencil-square"></i> Editar</button><br>
                            <button class="btn btn-delete"><i class="bi bi-trash3"></i> Excluir</button>
                        </td>
                        <td>Ricardo Menezes</td>
                        <td>326.652.654-00</td>
                        <td>06/06/1980</td>
                        <td>SP</td>
                        <td>São Paulo</td>
                        <td>M</td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-edit mb-1"><i class="bi bi-pencil-square"></i> Editar</button><br>
                            <button class="btn btn-delete"><i class="bi bi-trash3"></i> Excluir</button>
                        </td>
                        <td>Margaret Hamil</td>
                        <td>235.326.148-12</td>
                        <td>06/06/1995</td>
                        <td>RJ</td>
                        <td>Trindade</td>
                        <td>F</td>
                    </tr>
                    <tr>
                        <td>
                            <button class="btn btn-edit mb-1"><i class="bi bi-pencil-square"></i> Editar</button><br>
                            <button class="btn btn-delete"><i class="bi bi-trash3"></i> Excluir</button>
                        </td>
                        <td>Joan Clarke</td>
                        <td>032.324.674-78</td>
                        <td>06/06/2000</td>
                        <td>SC</td>
                        <td>Vilage</td>
                        <td>M</td>
                    </tr>
                </tbody>
            </table>

            <!-- Paginação -->
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <span class="page-link">« Anterior</span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item"><a class="page-link" href="#">6</a></li>
                    <li class="page-item"><a class="page-link" href="#">7</a></li>
                    <li class="page-item"><a class="page-link" href="#">8</a></li>
                    <li class="page-item"><a class="page-link" href="#">9</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Próximo »</a>
                    </li>
                </ul>
            </nav>

        </div>

    </div>
</template>

<script>

export default {
    name: "Consulta",
    data() {
        return {
            // 
        };
    },
    computed: {
        // 
    },
    methods: {}
};
</script>

<style scoped>
body {
    padding: 20px;
    background-color: #fff;
}

.container-custom {
    border-radius: 10px;
    max-width: 100%;
    /* ou 100% */
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

.pagination .page-link {
    color: #007bff;
}

.pagination .active .page-link {
    background-color: #007bff;
    border-color: #007bff;
    color: #fff;
}

table th,
table td {
    vertical-align: middle;
    text-align: center;
}
</style>