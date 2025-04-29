Erick Agostinho (@r4mpo) - 2025

# 📋 Cadastro de Clientes, Cidades e Representantes

Projeto desenvolvido com o objetivo de criar um sistema de Cadastro de Clientes, Cidades e Representantes, utilizando **PHP Laravel**, **MySQL** e **Vue.js**.
As Views se comunicam com os dados através de uma **API RESTful**, seguindo os princípios da arquitetura **SOLID**.

---

## 🎯 Objetivos

- Criar um sistema de cadastro completo de **Clientes**, **Cidades** e **Representantes**.
- Comunicação Front-End e Back-End através de **API Rest**.
- Scripts SQL específicos:
  - Retornar todos os representantes que atendem um cliente a partir do seu ID.
  - Retornar todos os representantes de uma determinada cidade.
- Disponibilização do **DDL da base de dados completa**.

---

## ✅ Requisitos Atendidos

- [X] Cadastro de Clientes, Cidades e Representantes
- [X] API REST para comunicação
- [X] Scripts SQL específicos
- [X] DDL completo da base de dados

---

## 🚀 Funcionalidades Adicionais

✨ Além dos requisitos obrigatórios, o projeto conta com:

- 🔒 **Login/Cadastro** com proteção de rotas (autenticação segura)
- 📚 **Documentação** via **Swagger** e **Postman**
- 🛠️ **Testes Unitários** com **PHPUnit**
- 🧱 Arquitetura baseada em **SOLID** (inspirada em: [perfect-laravel-base](https://github.com/r4mpo/perfect-laravel-base))
- 🎨 **Framework Front-end** com **Vue.js**, **Vue Router** e **Axios**
- ☑️ **Renderização** de caixas de seleção pelo back-end, favorecendo a segurança e praticidade

---

## 🛠️ Tecnologias Utilizadas

- **PHP** 8.2.12
- **Laravel** 12.0.1
- **MySQL**
- **Vue.js** 3.x (com VueRouter e Axios)
- **PHPUnit** para testes

---

## 📦 Passo a Passo para Instalação

```bash
-- Clonagem
git clone https://github.com/r4mpo/upd8-crud.git

-- Instalação
cd upd8-crud
composer install && composer update

-- Configuração
cp .env.example .env
php artisan key:generate

-- Migra tabelas MySQL
php artisan migrate

-- Gera Documentação
php artisan l5-swagger:generate
npm install && npm update

-- Build (front-end)
npm audit fix --force
npm run dev

-- Serve (back-end)
php artisan serve

-- Seeders
php artisan db:seed

-- Tests
php artisan test
```

```
-- Limpa
php artisan migrate:refresh
```

## 🧩 Arquitetura SOLID

O projeto foi estruturado seguindo os princípios  **SOLID** , visando  **alta escalabilidade** , **manutenção** e  **separação de responsabilidades**. Toda a comunicação com a base de dados é feita via **Repositories,** enquanto a lógica de negócio é tratada em **Services**. Controllers são responsáveis apenas por receber a requisição, validar dados e repassar para o Service correspondente.

🔗 Referência base da arquitetura utilizada: [perfect-laravel-base](https://github.com/r4mpo/perfect-laravel-base)

---

## 📝 Conclusão

Este projeto foi desenvolvido não apenas para atender às demandas técnicas propostas, mas também para demonstrar boas práticas de desenvolvimento, organização de código, segurança e qualidade de software. Busquei ir além dos requisitos obrigatórios para entregar um sistema **robusto**, **documentado** e **preparado para crescimento futuro**.

Obrigado por conferir meu projeto! Qualquer dúvida, estou à disposição! 🚀
