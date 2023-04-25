import { createRouter, createWebHashHistory } from 'vue-router'
import Index from '../views/Index.vue'
import ArticleDetail from '../views/ArticleDetail.vue'

const router = createRouter({
  history: createWebHashHistory(import.meta.env.BASE_URL),
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

router.beforeEach((to, from, next) => {
  document.body.scrollTop = 0
  document.documentElement.scrollTop = 0
  next()
})

export default router
