import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import ShareNetwork from 'vue-social-sharing'
import "./index.css";


const app = createApp(App)
app.use(router)
app.use(ShareNetwork)
app.mount('#app')
