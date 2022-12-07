import { createRouter, createWebHashHistory } from 'vue-router'
import ContactManage from '../views/ContactManage.vue'
import AddContact from '../views/AddContact.vue'
import ViewContact from '../views/ViewContact.vue'
import EditContact from '../views/EditContact.vue'
import PageNotFound from '../views/PageNotFound.vue'


const routes = [
    {
        path: '/',
        name: 'ContactManage',
        component: ContactManage
    },
    {
        path: '/add',
        name: 'AddContact',
        component: AddContact
    },
    {
        path: '/view/:id',
        name: 'ViewContact',
        component: ViewContact,
        props: true
    },
    {
        path: '/edit/:id',
        name: 'EditContact',
        component: EditContact,
        props: true
    },
    {
        path: "/:catchAll(.*)",
        name: 'PageNotFound',
        component: PageNotFound
    },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
