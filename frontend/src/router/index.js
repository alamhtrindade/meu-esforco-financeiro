import Vue from 'vue'; // Importando o Vue
import VueRouter from 'vue-router'; // Importando o VueRouter corretamente para Vue 2

// Importando os componentes das páginas
const WelcomePage = () => import('@/views/pages/WelcomePage.vue'); // Lazy loading

// Usando o VueRouter globalmente
Vue.use(VueRouter);

// Definindo as rotas
const routes = [
  {
    path: '/',
    name: 'welcome',
    component: WelcomePage, // Componente correto
  },
];

// Criando o roteador
const router = new VueRouter({
  mode: 'history', // Usando o histórico baseado em HTML5
  routes, // Registrando as rotas
});

export default router;
