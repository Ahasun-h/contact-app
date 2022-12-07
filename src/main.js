import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'

/** Bootstrap Css, Js **/
import '../node_modules/bootstrap/dist/css/bootstrap.min.css'
import '../node_modules/bootstrap/dist/js/bootstrap'

import '../node_modules/@fortawesome/fontawesome-free/css/all.min.css'

import './style.css'


createApp(App).use(store).use(router).mount('#app')
