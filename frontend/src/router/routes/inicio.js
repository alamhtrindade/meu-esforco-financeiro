
export default [
    {
      path: '/',
      name: 'index',
      component: () => import('@/views/pages/miscellaneous/BemVindo.vue'),
      meta: {
        layout: 'normal',
        title: 'Página Inicial'
      },
    },
  ]