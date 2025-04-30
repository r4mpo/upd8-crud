<template>
  <div class="home-container">
    <div class="row justify-content-center">
      <!-- CARD TEMPLATE -->
      <div
        v-for="(card, index) in cards"
        :key="index"
        class="col-md-3"
      >
        <div
          class="card card-feature"
          @mouseover="hoverCard = card.id"
          @mouseleave="hoverCard = ''"
        >
          <div :class="['card-body', { 'card-hover': hoverCard === card.id }]">
            <div class="icon-wrapper mb-3">
              <i :class="card.icon" class="icon"></i>
            </div>
            <h5 class="card-title">{{ card.title }}</h5>
            <div class="btn-group-vertical w-100 mt-3">
              <router-link
                v-for="(action, i) in card.actions"
                :key="i"
                :to="action.route"
                class="btn btn-outline-primary mb-2"
              >
                <i :class="action.icon" class="me-2"></i>{{ action.label }}
              </router-link>
            </div>
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
      cards: [
        {
          id: 'cidades',
          title: 'Cidades',
          icon: 'fas fa-city',
          actions: [
            { label: 'Consultar', route: '/cidades/consulta', icon: 'fas fa-search' },
            { label: 'Registrar', route: '/registrar-cidades', icon: 'fas fa-plus-circle' },
          ],
        },
        {
          id: 'clientes',
          title: 'Clientes',
          icon: 'fas fa-users',
          actions: [
            { label: 'Consultar', route: '/clientes/consulta', icon: 'fas fa-search' },
            { label: 'Registrar', route: '/clientes/analisa', icon: 'fas fa-plus-circle' },
          ],
        },
        {
          id: 'representantes',
          title: 'Representantes',
          icon: 'fas fa-user-tie',
          actions: [
            { label: 'Consultar', route: '/representantes/consulta', icon: 'fas fa-search' },
            { label: 'Registrar', route: '/representantes/analisa', icon: 'fas fa-plus-circle' },
          ],
        },
        {
          id: 'relatorios',
          title: 'Relatórios',
          icon: 'fas fa-chart-bar',
          actions: [
            { label: 'Representantes por ID Cliente', route: '/representantes-por-id-cliente', icon: 'fas fa-id-card' },
            { label: 'Filtrar por Cidade', route: '/filtrar-representantes-por-cidade', icon: 'fas fa-filter' },
          ],
        },
      ],
    };
  },
};
</script>

<style scoped>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css');

.home-container {
  background: #f9f9f9;
  padding: 40px 20px;
  min-height: 100vh;
}

.card-feature {
  border-radius: 15px;
  box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
  margin: 15px;
  background: #fff;
  transition: all 0.3s ease-in-out;
  text-align: center;
}

.card-feature:hover {
  transform: translateY(-8px);
  box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
}

.card-body {
  padding: 25px;
  transition: background-color 0.3s ease;
}

.card-title {
  font-size: 1.25rem;
  font-weight: bold;
  color: #333;
  text-transform: uppercase;
}

.icon-wrapper {
  font-size: 2.5rem;
  color: #007bff;
}

.btn-group-vertical .btn {
  text-align: left;
  font-weight: 500;
}

.btn i {
  width: 20px;
  text-align: center;
}

.card-hover {
  background-color: #f1f1f1;
}
</style>
