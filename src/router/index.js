import { createRouter, createWebHistory } from 'vue-router'
import Index from '../views/Index.vue'
import ArticleDetail from '../views/ArticleDetail.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'Idx',
      component: Index
    },
    {
      path: "/articledetail",
      name: "ArticleDetail",
      component: ArticleDetail,
    },
  ]
})

export default router
