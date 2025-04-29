<template>
    <div class="home-container">
      <div class="row justify-content-center">
        <!-- Card Cidades -->
        <div class="col-md-3">
          <div
            class="card card-feature"
            @mouseover="hoverCard = 'cidades'"
            @mouseleave="hoverCard = ''"
          >
            <div :class="['card-body', { 'card-hover': hoverCard === 'cidades' }]">
              <h5 class="card-title">Cidades</h5>
              <ul>
                <router-link to="/cidades/consulta" tag="li">Consultar</router-link>
                <router-link to="/registrar-cidades" tag="li">Registrar</router-link>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Card Clientes -->
        <div class="col-md-3">
          <div
            class="card card-feature"
            @mouseover="hoverCard = 'clientes'"
            @mouseleave="hoverCard = ''"
          >
            <div :class="['card-body', { 'card-hover': hoverCard === 'clientes' }]">
              <h5 class="card-title">Clientes</h5>
              <ul>
                <router-link to="/clientes/consulta" tag="li">Consultar</router-link>
                <router-link to="/registrar-clientes" tag="li">Registrar</router-link>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Card Representantes -->
        <div class="col-md-3">
          <div
            class="card card-feature"
            @mouseover="hoverCard = 'representantes'"
            @mouseleave="hoverCard = ''"
          >
            <div :class="['card-body', { 'card-hover': hoverCard === 'representantes' }]">
              <h5 class="card-title">Representantes</h5>
              <ul>
                <router-link to="/representantes/consulta" tag="li">Consultar</router-link>
                <router-link to="/registrar-representantes" tag="li">Registrar</router-link>
              </ul>
            </div>
          </div>
        </div>
  
        <!-- Card Relatórios -->
        <div class="col-md-3">
          <div
            class="card card-feature"
            @mouseover="hoverCard = 'relatorios'"
            @mouseleave="hoverCard = ''"
          >
            <div :class="['card-body', { 'card-hover': hoverCard === 'relatorios' }]">
              <h5 class="card-title">Relatórios</h5>
              <ul>
                <router-link to="/representantes-por-id-cliente" tag="li">Representantes por ID Cliente</router-link>
                <router-link to="/filtrar-representantes-por-cidade" tag="li">Filtrar Representantes por Cidade</router-link>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        hoverCard: '',
      };
    },
  };
  </script>
  
  <style scoped>
  .home-container {
    background: #fafafa;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    height: 100vh;
    padding: 20px;
  }
  
  .card-feature {
    border-radius: 12px;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    margin: 15px;
    background: #fff;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    align-items: center;
    cursor: pointer;
  }
  
  .card-feature:hover {
    transform: translateY(-4px);
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
  }
  
  .card-body {
    padding: 20px;
    text-align: center;
    position: relative;
    transition: background-color 0.3s ease;
    height: 200px;
  }
  
  .card-body h5 {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
    margin-bottom: 12px;
    text-transform: uppercase;
  }
  
  .card-body ul {
    list-style: none;
    padding: 0;
    margin-top: 20px;
  }
  
  .card-body ul li {
    font-size: 1rem;
    color: #555;
    padding: 8px 0;
    transition: color 0.3s ease;
  }
  
  .card-body ul li:hover {
    color: #007bff;
  }
  
  .card-feature .card-body {
    background-color: #fff;
  }
  
  .card-hover {
    transform: scale(1.05);
  }
  
  .card-feature:hover .card-body {
    background-color: #f0f0f0;
  }
  
  @media (max-width: 768px) {
    .home-container {
      flex-direction: column;
    }
  
    .col-md-3 {
      margin-bottom: 30px;
    }
  }
  </style>
  