
import VuePage from "./components/pages/VuePage.vue";
import hook from "./components/hooks/hooks.vue"

//admin project pages
import Home from "./components/pages/Home.vue"
import Tags from "./admin/pages/Tags.vue"
import Category from "./admin/pages/Category.vue"

const routes =[
    //project routes
    {
        path:'/',
        component:Home
    },
    {
        path:'/category',
        component:Category
    },
    {
        path:'/tags',
        component:Tags
    },
//basic routes
    {
        path:'/vue-route',
        component:VuePage
    },
    {
        path:'/vue-hook',
        component:hook
    }
]


export default routes;