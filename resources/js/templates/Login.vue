<template>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="card shadow mt-5">
            <div class="card-header text-center bg-white border-bottom-0">
              <img src="../../../public/images/upd8.png" width="100" height="100" alt="Logo empresa upd8" />
              <div class="row mt-3">
                <div class="col-6">
                  <a href="#" :class="{ 'text-success fw-bold': loginAtivo }" @click.prevent="mostrarLogin">
                    Entrar
                  </a>
                </div>
                <div class="col-6">
                  <a href="#" :class="{ 'text-success fw-bold': !loginAtivo }" @click.prevent="mostrarCadastro">
                    Cadastrar-se
                  </a>
                </div>
              </div>
              <hr />
            </div>
            <div class="card-body">
              <form v-if="loginAtivo" @submit.prevent="enviarLogin">
                <div class="mb-3">
                  <input type="email" v-model="login.email" @blur="validarEmail" class="form-control"
                    :class="{ 'is-invalid': !emailValido }" placeholder="E-mail" />
                  <div v-if="!emailValido" class="invalid-feedback">E-mail inválido</div>
                </div>
                <div class="mb-3">
                  <input type="password" v-model="login.senha" class="form-control" placeholder="Senha" />
                </div>
                <div class="mb-3">
                  <button type="submit" class="btn btn-login w-100" :disabled="!loginValido">Entrar</button>
                </div>
              </form>
  
              <form v-else @submit.prevent="enviarCadastro">
                <div class="mb-3">
                  <input type="text" v-model="cadastro.nome" @blur="validarNome" class="form-control"
                    :class="{ 'is-invalid': !nomeValido }" placeholder="Nome" />
                  <div v-if="!nomeValido" class="invalid-feedback">Nome deve ter pelo menos 3 caracteres</div>
                </div>
                <div class="mb-3">
                  <input type="email" v-model="cadastro.email" @blur="validarEmail" class="form-control"
                    :class="{ 'is-invalid': !emailValido }" placeholder="E-mail" />
                  <div v-if="!emailValido" class="invalid-feedback">E-mail inválido</div>
                </div>
                <div class="mb-3">
                  <input type="password" v-model="cadastro.senha" @blur="validarSenha" class="form-control"
                    :class="{ 'is-invalid': !senhaValida }" placeholder="Senha" />
                  <div v-if="!senhaValida" class="invalid-feedback">Senha deve ter pelo menos 6 caracteres</div>
                </div>
                <div class="mb-3">
                  <input type="password" v-model="cadastro.confirmacaoSenha" @blur="validarConfirmacaoSenha"
                    class="form-control" :class="{ 'is-invalid': !confirmacaoSenhaValida }"
                    placeholder="Confirmar senha" />
                  <div v-if="!confirmacaoSenhaValida" class="invalid-feedback">As senhas não coincidem</div>
                </div>
                <div class="mb-3">
                  <button type="submit" class="btn btn-registrar w-100" :disabled="!cadastroValido">Cadastrar</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
<script>
import { login, registrar } from '../helpers/axios';

export default {
    name: "Login",
    data() {
        return {
            loginAtivo: true,
            login: { email: '', senha: '' },
            cadastro: { nome: '', email: '', senha: '', confirmacaoSenha: '' },
            emailValido: true,
            nomeValido: true,
            senhaValida: true,
            confirmacaoSenhaValida: true,
            cadastroValido: false // Inicializa como falso
        };
    },
    computed: {
        loginValido() {
            return this.login.email && this.login.senha;
        }
    },
    methods: {
        mostrarLogin() {
            this.loginAtivo = true;
        },
        mostrarCadastro() {
            this.loginAtivo = false;
        },
        validarEmail() {
            const email = this.loginAtivo ? this.login.email : this.cadastro.email;
            const regex = /^[^\s@]+@[a-zA-Z0-9.-]+(\.[a-zA-Z]{2,})?$/;
            this.emailValido = regex.test(email);
            this.validarCadastro();
        },
        validarNome() {
            this.nomeValido = this.cadastro.nome.length >= 3;
            this.validarCadastro();
        },
        validarSenha() {
            this.senhaValida = this.cadastro.senha.length >= 6;
            this.validarCadastro();
        },
        validarConfirmacaoSenha() {
            this.confirmacaoSenhaValida = this.cadastro.senha === this.cadastro.confirmacaoSenha;
            this.validarCadastro();
        },
        validarCadastro() {
            this.cadastroValido = this.nomeValido && this.emailValido && this.senhaValida && this.confirmacaoSenhaValida;
        },
        exibirUmaMensagemPersonalizada(mensagem, texto, icone) {
            Swal.fire({
                title: mensagem,
                text: texto,
                icon: icone
            });
        },
        async enviarLogin() {
            try {
                let respostaLogin = await login(this.login.email, this.login.senha);
                sessionStorage.setItem('token', respostaLogin.resposta.token);
                this.$router.push('/');
            } catch (erro) {
                this.exibirUmaMensagemPersonalizada('Ops!', 'Usuário ou senha inválidos, tente novamente!', 'error');
            }
        },
        async enviarCadastro() {
            try {
                let respostaLogin = await registrar(this.cadastro.nome, this.cadastro.email, this.cadastro.senha);
                sessionStorage.setItem('token', respostaLogin.resposta.token);
                this.$router.push('/');
            } catch (erro) {
                this.exibirUmaMensagemPersonalizada('Ops!', 'Houve um problema ao registrar usuário, tente novamente!', 'error');
            }
        }
    }
};
</script>

<style scoped>
.is-invalid input {
    border-color: red !important;
}

.is-invalid small {
    display: block;
}

body {
    padding-top: 90px;
}

.panel-login {
    margin-top: 30%;
    border-color: #ccc;
    -webkit-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
    -moz-box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
    box-shadow: 0px 2px 3px 0px rgba(0, 0, 0, 0.2);
}

.panel-login>.panel-heading {
    color: #00415d;
    background-color: #fff;
    border-color: #fff;
    text-align: center;
}

.panel-login>.panel-heading a {
    text-decoration: none;
    color: #666;
    font-weight: bold;
    font-size: 15px;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    transition: all 0.1s linear;
}

.panel-login>.panel-heading a.active {
    color: #029f5b;
    font-size: 18px;
}

.panel-login>.panel-heading hr {
    margin-top: 10px;
    margin-bottom: 0px;
    clear: both;
    border: 0;
    height: 1px;
    background-image: -webkit-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
    background-image: -moz-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
    background-image: -ms-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
    background-image: -o-linear-gradient(left, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.15), rgba(0, 0, 0, 0));
}

.panel-login input[type="text"],
.panel-login input[type="email"],
.panel-login input[type="password"] {
    height: 45px;
    border: 1px solid #ddd;
    font-size: 16px;
    -webkit-transition: all 0.1s linear;
    -moz-transition: all 0.1s linear;
    transition: all 0.1s linear;
}

.panel-login input:hover,
.panel-login input:focus {
    outline: none;
    -webkit-box-shadow: none;
    -moz-box-shadow: none;
    box-shadow: none;
    border-color: #ccc;
}

.btn-login {
    background-color: #59B2E0;
    outline: none;
    color: #fff;
    font-size: 14px;
    height: auto;
    font-weight: normal;
    padding: 14px 0;
    text-transform: uppercase;
    border-color: #59B2E6;
}

.btn-login:hover,
.btn-login:focus {
    color: #fff;
    background-color: #53A3CD;
    border-color: #53A3CD;
}

.forgot-password {
    text-decoration: underline;
    color: #888;
}

.forgot-password:hover,
.forgot-password:focus {
    text-decoration: underline;
    color: #666;
}

.btn-registrar {
    background-color: #1CB94E;
    outline: none;
    color: #fff;
    font-size: 14px;
    height: auto;
    font-weight: normal;
    padding: 14px 0;
    text-transform: uppercase;
    border-color: #1CB94A;
}

.btn-registrar:hover,
.btn-registrar:focus {
    color: #fff;
    background-color: #1CA347;
    border-color: #1CA347;
}
</style>