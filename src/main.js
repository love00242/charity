import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import ShareNetwork from 'vue-social-sharing'
import { createMetaManager} from 'vue-meta'
import "./index.css";

const app = createApp(App)
app.use(createMetaManager(false, {
    meta: { tag: 'meta', nameless: true }
}))
app.use(router)
app.use(ShareNetwork)
app.mount('#app')
