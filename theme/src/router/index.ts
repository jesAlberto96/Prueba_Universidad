import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'inicio',
      component: () => import('@/views/HomeView.vue'),
    },
    {
      path: '/estudiantes/create',
      name: 'RegistroEstudiantes',
      component: () => import('@/views/estudiantes/CreateForm.vue'),
    },
    {
      path: '/estudiantes/edit/:id',
      name: 'EditarEstudiante',
      component: () => import('@/views/estudiantes/EditForm.vue'),
      props: true
    }
  ]
})

export default router
